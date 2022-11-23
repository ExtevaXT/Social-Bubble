<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;




    public function chat()
    {
        return $this->hasMany(Chat::class);
    }

    //friend feature
    protected $casts = ["friends" => "array"];
    //check friend
    public function friend(string $login, $default = null)
    {
        return collect($this->friends)->where('login',$login)->isNotEmpty();
    }
    public function friendDelete($login) : self
    {
        $arr = collect($this->friends);
        //need to remove array element by login, everything removes it by key

        //$arr->forget($arr->firstWhere('login', $login));
        $arr->map(function ($item, $key) use ($arr, $login) {
            if($item['login'] == $login) unset($arr[$key]);
            return $item;
        });
        $this->friends = $arr;
        $this->save();
        return $this;
    }
    public function friendAccept($login) : self
    {
        //need to change accepted to true
        $arr = collect($this->friends);

        //$friend = $arr->where('login', $login);
        //$friend->first()['accepted'] = true;
        //dd($arr->replaceRecursive($friend));
        $arr = $arr->map(function ($item) use ($login) {
            if($item['login'] == $login) $item['accepted'] = true;
            return [
                'login' => $item['login'],
                'canAccept' => $item['canAccept'],
                'accepted' => $item['accepted']
            ];
        });
        $this->friends = $arr->toArray();
        $this->save();
        return $this;
    }
    /**
     * Update one or more settings and then optionally save the model.
     *
     */
    public function friends(array $revisions, bool $save = true) : self
    {
        $this->friends = array_merge($this->friends, $revisions);
        if ($save) {
            $this->save();
        }
        return $this;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'login',
        'password',
        'birthday',
        'country',
        'city',
        'hobby',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
