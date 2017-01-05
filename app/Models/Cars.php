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

    //words can be filled;
    protected $guared = ['uid'];

    //find all car's info
    public function findAll()
    {
        $carList = $this->all();
        return $carList;
    }



    //update Position
    public function updateLocation($uid, $latitude, $longitude, $locateTime)
    {
        $model = static::find($uid);
        $model->latitude = $latitude;
        $model->langitude = $longitude;
        $model->recordtime = time();
        $model->save();
    }

    //get latitude




}