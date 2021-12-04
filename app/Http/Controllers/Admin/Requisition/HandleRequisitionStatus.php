<?php

namespace App\Http\Controllers\Admin\Requisition;

use App\Http\Controllers\Controller;
use App\Models\Requisition;
use App\Models\RequisitionModificationRequest;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HandleRequisitionStatus extends Controller
{
    public function AdminAccept(Request $request){
        /*
        |--------------------------------------------
        | Here the admin can accept the modification
        |--------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->RequisitionId);
        $requisition->update([
            'driver_id' => $request->DriverId,
            'status' => Requisition::ACCEPTED,
        ]);
        return response()->json(__('admin.accepted_requisition'));
    }

    public function AdminAskForEdit(Request $request){
        /*
        |----------------------------------------------------------------------
        | Here the admin can ask for requisition modification like time or date
        |----------------------------------------------------------------------
        */
        $countIfExist = RequisitionModificationRequest::where('requisition_id',$request->RequisitionId)->get()->count();
        if($countIfExist){
            return response()->json(__('admin.modification_already_Sent'));
        }
        RequisitionModificationRequest::create([
            'new_time_from'=> $request->NewFromTime,
            'new_time_to'=> $request->NewToTime,
            'requisition_id'=> $request->RequisitionId,
            'client_id'=> $request->ClientId,
            'user_id'=> $request->UserId,
            'status' => 0
        ]);
        $requisition = Requisition::findOrFail($request->RequisitionId);
        $requisition->update([
            'status' => Requisition::SENTFORMODIFICATION,
        ]);
        return response()->json(__('admin.sent_for_modification'));
    }


    public function ClientTrackRequisition(Request $request){
        /*
        |--------------------------------------------------------------------------------
        | Here the client can track his requisitions to know the status or take an action
        |--------------------------------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->id);
        $modificaion = null;
        $countIfExist = RequisitionModificationRequest::where('requisition_id',$request->id)->first();
        if(!is_null($countIfExist)){
            if($countIfExist->count()){
                $modificaion = $countIfExist;
            }
        }
        return view('admin.pages.requisition.track-order',compact('requisition','modificaion'));
    }

    public function ClientAcceptModification(Request $request){
        /*
        |------------------------------------------------------------
        | Here the client accepts the modification on the requisition
        |------------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->requisition_id);
        // updating status to accepted and updating new time
        $requisition->update([
            'status' => Requisition::ACCEPTED,
            'time_to' => $request->time_to,
            'time_from' => $request->time_from,
        ]);
        // deleting the modification request after the client accept the modification
        RequisitionModificationRequest::where('requisition_id',$request->requisition_id)
        ->where('client_id',Auth::id())->first()->delete();
        toastr()->success('admin.modification_accepted');
        return redirect()->route('admin.dashboard');
    }

    public function ClientDenyModification($id){
        /*
        |--------------------------------------------------------------------------------------------
        | Here the client refuse the modification that admin has sent then the requisition is deleted
        |--------------------------------------------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($id);
        $requisition->delete();
        toastr()->success(__('admin.destroy_success_message'));
        return redirect()->route('admin.requisition.index');
    }

    public function DriverShowRequisition($id){
        /*
        |---------------------------------------------------------------------------------
        | Here the driver can see the requisition to take an action (verify-start-deliver)
        |---------------------------------------------------------------------------------
        */
        $employees = User::role('employee')->get();
        $drivers = User::role('driver')->get();
        $vehicle_types = VehicleType::get();
        $purposes = ['official','picnic','travel'];
        $requisition = Requisition::findOrFail($id);
        return view('admin.pages.requisition.driver-show',[
            'employees' => $employees,
            'drivers' => $drivers,
            'vehicle_types' => $vehicle_types,
            'purposes' => $purposes,
            'requisition' => $requisition,
        ]);
    }

    public function DriverVerifyRequisition(Request $request){
        /*
        |----------------------------------------------------------
        | Here the driver confirm that he has seen the requisition
        |----------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'status' => Requisition::VERIFIED,
        ]);
        return response()->json(__('admin.verified'));
    }


    public function DriverStartRequisition(Request $request){
        /*
        |--------------------------------------------------------------------
        | Here the driver start to move with his vehicle to deliver the order
        |--------------------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'status' => Requisition::STARTED,
        ]);
        return response()->json(__('admin.started'));
    }

    public function ClientFirstSignature(Request $request){
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'client_first_signature' => $request->output
        ]);
        toastr()->success(__('admin.signature_success'));
        return back();
    }

    public function ClientSecondSignature(Request $request){
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'client_second_signature' => $request->output
        ]);
        toastr()->success(__('admin.signature_success'));
        return back();
    }

    public function DriverFirstSignature(Request $request){
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'driver_first_signature' => $request->output,
        ]);
        toastr()->success(__('admin.signature_success'));
        return back();
    }

    public function DriverSecondSignature(Request $request){
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'driver_second_signature' => $request->output
        ]);
        toastr()->success(__('admin.signature_success'));
        return back();
    }


    public function DriverFinishRequisition(Request $request){
        /*
        |--------------------------------------------------------------
        | Here the driver confirm that he has delivered the requisition
        | to the required destination
        |--------------------------------------------------------------
        */
        $requisition = Requisition::findOrFail($request->id);
        $requisition->update([
            'status' => Requisition::DELIVERED,
            'delivered_at' => date("Y-m-d")
        ]);
        return response()->json(__('admin.delivered'));
    }

    public function RequisitionPrint($id){
        $requisition = Requisition::findOrFail($id);
        if(Auth::id() != $requisition->driver_id && !Auth::user()->hasRole('admin')){
            abort(403);
        }
        $system = SystemSetting::first();
        $invoice_header = count($system->getMedia('invoice_header')) > 0 ? $system->getMedia('invoice_header')->first()->getUrl() : null;
        $invoice_footer = count($system->getMedia('invoice_footer')) > 0 ? $system->getMedia('invoice_footer')->first()->getUrl() : null;
        $vehicle = Vehicle::where('driver_id', $requisition->driver_id)->first();
        $items = $requisition->items;
        return view('admin.pages.fatoora.index',compact('requisition','vehicle','items','invoice_header','invoice_footer','system'));
    }
}
