<?php

namespace App\Helpers;

class Acl
{
    public static function getAclList(){
        return [
            "/admin" => ["admin"]
        ];
    }

    public static function getPermissions($userType, $path)
    {
        $result = [
            "rolesAllowed" => [],
            "success" => false
        ];

        foreach (self::getAclList() as $key => $value){
            if($path == $key){
                $rolesAllowed = $value;
                $result["rolesAllowed"] = $rolesAllowed;
                if(in_array($userType, $value)){
                    $result = [
                        "success" => true
                    ];
                    break;
                }
            }
        }

        return $result;
    }
}