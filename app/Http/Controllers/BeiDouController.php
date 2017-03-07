<?php

namespace App\Http\Controllers;

use App\Models\CarPoint;
use Illuminate\Http\Request;
use App\Models\Cars;
use Validator;

class BeiDouController extends Controller
{
    const DIFF_METER = 10;
    //回应Get请求，地址为/,返回所有车辆信息
    public function index()
    {
        $data = Cars::all();
        if(empty($data))
            return '404';
        else return $data;
    }

    //回应Get请求，地址为/{id},返回指定车辆信息
    public function show($id)
    {
        //return 'show'.$id;
        $data = Cars::find($id);
        if(empty($data))
            return '404';
        else return $data;
    }

    /**
     *  @desc 根据两点间的经纬度计算距离
     *  @param float $lat 纬度值
     *  @param float $lng 经度值
     * @return float 距离米
     */
    public function getDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6367000; //approximate radius of earth in meters

        /*
          Convert these degrees to radians
          to work with the formula
        */

        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;

        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;

        /*
          Using the
          Haversine formula

          http://en.wikipedia.org/wiki/Haversine_formula

          calculate the distance
        */

        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;

        return round($calculatedDistance);
    }

    //编辑Get请求，地址为/{id}/edit,修改指定车辆信息
    public function edit(Request $request,$id)
    {
        //检查id是否存在
        $data = Cars::find($id);
        if(empty($data))
            return '404';

        //校验参数
        $validator = $this->validator($request->all());
        if($validator->fails())
        {
            return 'error: ' . 'wrong params';
        }

        try{
            //从get请求中获取参数
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
            $speed = $request->input('speed');
            $angle = $request->input('angle');
            $locatetime = $request->input('locatetime');
            $state = $request->input('state');

//            $d=mktime(9, 12, 31, date("m"), date("d"), date("Y"));
//            echo "创建日期是 " . date("Y-m-d h:i:sa", $d);

            $timestamp = date('Y-m-d H:i:s');
            $time = empty($locatetime)? $timestamp : $locatetime;
            $mCar = Cars::find($id);


            //位置有变化，插入轨迹数据表
            $diff = $this->getDistance($mCar->latitude,$mCar->longitude,$latitude,$longitude);
            if($diff
                > self::DIFF_METER
            )
            {
                $ptsModel = new CarPoint();
                $ptsModel->insertCarPoints($id, $latitude, $longitude, $speed, $angle, $time);
            }

            //更新坐标信息
            $mCar->updateLocation($id,$latitude,$longitude,$speed,$angle,$time,$state);

            return $diff;//'success';
        }

        //捕获异常
        catch(Exception $e)
        {
            return 'error: ' .$e->getMessage();
        }
    }

    public function trace($id)
    {
        try{
            $ptsModel = new CarPoint();
            $result = $ptsModel->findPts($id);
            return $result;
        }

        //捕获异常
        catch(Exception $e)
        {
            return 'error: ' .$e->getMessage();
        }
    }
    //校验终端传来数据是否合法
    protected function validator(array $data)
    {
        return Validator::make($data,[
                'latitude' => 'required|numeric',
                'longitude' => 'required|numeric',
                'speed' => 'required|numeric',
                'angle' => 'required|numeric',
                'locatetime' => 'date',
                'state' => 'required|integer'
            ]
        );
    }


}
