<?php

namespace App\Http\Controllers;

use App\Property;
use App\Http\Controllers\Controller;
use Request;
use View;
use Input;
use Response;

class PropertyController extends Controller
{
    public function index()
    {
        $inputs = Input::all();
        $properties=$this->search_property($inputs);
        return Response::json($properties);

    }

    /*Search Property function
     * @params=[id=>1,name=>namequery,bedrooms=>2,
     *                      limit=>10,page=>2,
     *                      sort_by=>field asc]
     *
     */
    public function search_property($params=null)
    {
        /* Initialize all default value*/
        $limit = 3;
        $sort_by="created_at desc";
        $where ='1';

        foreach($params as $key=>$value)
        {
            if($value) {
                switch ($key) {
                    case 'name':
                        //TODO:validate the value
                        $where = $where . " AND $key LIKE '%$value%'";
                        break;
                    case 'bedrooms':
                    case 'bathrooms':
                    case 'storeys':
                    case 'garages':
                    case 'id':
                        //TODO:validate the value
                        $where = $where . " AND $key = '$value'";
                        break;
                    case 'fromprice':
                        $where = $where . " AND price >= '$value'";
                        break;
                    case 'toprice':
                        $where = $where . " AND price <= '$value'";
                        break;
                    //HANDLE for sorting and more records in a page
                    case 'sort_by':
                        //TODO: check valid column and valid direction of the sort
                        $sort_by = $value;
                        break;
                    case 'limit':
                        //TODO:validate the value
                        $limit = $value;
                        break;

                }
            }
        }

        $properties = Property::whereraw($where)->orderByRaw($sort_by)->get();
        return $properties;
    }
}
