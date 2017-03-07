<?php  namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 17-1-3
 * Time: 下午4:40
 */
class CarPoint extends Model
{
    //the name of databasetable
    protected $table = 'carsPts';

    //do not use the timestamps store func provided by laravel
    public $timestamps = false;

    //保护字段;
    protected $guared = ['id'];

    //find all carspts
    public function findAll()
    {
        $carsPtsList = $this->all();
        return $carsPtsList;
    }

    //find all carspts
    public function findPts($carID)
    {
        $carsPtsList = DB::table('carsPts')
                           ->where('carID',$carID)
                           ->get();
        return $carsPtsList;
    }



    //insert history points
    public function insertCarPoints($carID,$latitude,$longitude,$speed,$angle,$time)
    {
        $id = DB::table('carsPts')->insertGetId(
            array(
                'carID' => $carID,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'speed' => $speed,
                'angle' => $angle,
                'locatetime' => $time,
                )
        );
    }

    //get latitude
}