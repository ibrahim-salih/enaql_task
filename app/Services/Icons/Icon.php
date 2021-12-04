<?php

namespace App\Services\Icons;

class Icon{

    public static function Edit($route){
        return '<button class="btn btn-success mx-2"><a class="text-white" href="'.$route.'">'.__('admin.edit').'<i class="fas fa-edit ml-2"></i></a></button>';
    }

    public static function Delete($route){
        return '<button type="button" class="btn btn-danger delete_btn text-white mx-2" data-toggle="modal" data-target="#delete" data-route="'.$route.'">'.__('admin.delete').'<i class="fas fa-trash-alt ml-2"></i></button>';
    }

    public static function EditWithModal($Editroute,$Updateroute){
        return '<button data-edit="'.$Editroute.'" data-update="'.$Updateroute.'" type="button" class="btn btn-primary edit_btn" data-toggle="modal" data-target="#EditModal">
        '.__('admin.edit').' <i class="fas fa-edit ml-2"></i>
    </button>';
    }

    public static function Show($route){
        return '<button class="btn btn-primary mx-2"><a class="text-white" href="'.$route.'">'.__('admin.show').'<i class="fas fa-eye ml-2"></i></a></button>';
    }

    public static function Track($route){
        return '<button class="btn btn-primary mx-2"><a class="text-white" href="'.$route.'">'.__('admin.track').'<i class="fas fa-eye ml-2"></i></a></button>';
    }

}
