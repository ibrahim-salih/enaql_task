<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ApprovelAuthority;
use App\Models\Expense;
use App\Models\Insurance;
use App\Models\Maintenanace;
use App\Models\MaintenanceData;
use App\Models\Part;
use App\Models\PickDropRequisition;
use App\Models\Purchase;
use App\Models\Requisition;
use App\Models\Route;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use LaravelLocalization;
class DashboardController extends Controller
{
    public function index(){
        $drivers = User::role('driver')->count();
        $vehicles = Vehicle::count();
        $insurances = Insurance::count();
        $employees = User::role('employee')->count();
        $requsitions = Requisition::count();
        $routes = Route::count();
        $maintenances = Maintenanace::count();
        $expenses = Expense::count();
        $parts = Part::count();
        $purchases = Purchase::count();
        $clients = User::role('client')->count();
        return view('admin.pages.dashboard.index' , [
            'drivers' => $drivers,
            'vehicles' => $vehicles,
            'insurances' => $insurances,
            'employees' => $employees,
            'requsitions' => $requsitions,
            'routes' => $routes,
            'maintenances' => $maintenances,
            'expenses' => $expenses,
            'parts' => $parts,
            'purchases' => $purchases,
            'clients' => $clients,
        ]);
    }

    public function setLocale(Request $request){
        $url = LaravelLocalization::getLocalizedURL($request->locale, $request->url);
        return redirect(url($url));
    }
}
