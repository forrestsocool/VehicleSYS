<?php  namespace App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-1-3
 * Time: 下午4:40
 */
class Cars extends Model
{
    //the name of databasetable
    protected $table = 'cars';

    //do not use the timestamps store func provided by laravel
    public $timestamps = false;

    //保护字段;
    protected $guared = ['id'];

    //find all car's info
    public function findAll()
    {
        $carList = $this->all();
        return $carList;
    }


    //update Position
    public function updateLocation($id,$latitude,$longitude,$speed,$angle,$time,$state)
    {
        $model = static::find($id);
        $model->latitude = $latitude;
        $model->longitude = $longitude;
        $model->speed = $speed;
        $model->angle = $angle;
        $model->locateTime = $time;
        $model->state = $state;
        $model->recordTime = date('Y-m-d H:i:s');
        $model->save();
    }

    //get latitude
    public function getLatitude($id)
    {
        $model = static::find($id);
        return $model->latitude;
    }

    //get longitude
    public function getLongitude($id)
    {
        $model = static::find($id);
        return $model->longitude;
    }

}