<?php   namespace App\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    //datasheet name
    protected $table = 'users';

    //does not use the timestamps provided by Laravel
    public $timestamps = false;

    //words can be filled
    protected $fillable = ['username','account','password','addtime'];

    //protect word
    protected $guarded = ['id'];

    //find all users
    public function findAll()
    {
        $userList = $this->all();
        return $userList;
    }
}


?>
