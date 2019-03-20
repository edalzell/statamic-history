<?php

namespace Statamic\Addons\History\Models;

use Statamic\API\User;
use Statamic\API\Content;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'sqlite';

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $dates = ['created_at', 'updated_at', 'last_modified'];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['last_modified'];

    public static function findByContentId($id)
    {
        return self::where('content_id', $id)->orderBy('created_at')->get();
    }

    /**
     * @return \Statamic\Data\Users\User
     */
    public function getUserAttribute()
    {
        return User::find($this->user_id);
    }

    /**
     * @param \Statamic\Contracts\Data\Users\User $user
     *
     * @return void
     */
    public function setUserAttribute($user)
    {
        $this->user_id = $user->id();
    }

    /**
     * @return \Statamic\Contracts\Data\Content
     */
    public function getContentAttribute()
    {
        return Content::find($this->content_id);
    }

    /**
     * @param \Statamic\Contracts\Data\Content $content
     *
     * @return void
     */
    public function setContentAttribute($content)
    {
        $this->content_id = $content->id();
    }

    public function setActionAttribute($event)
    {
        $this->attributes['action'] = get_class($event);
    }

    public function getLastModifiedAttribute()
    {
        return $this->created_at;
    }

    /**
     * Scope a query to only include records edited by a particular user.
     *
     * @param \Statamic\Contracts\Data\Users\User $user
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWhereUser($query, $user)
    {
        return $query->where('user_id', $user->id());
    }

    public function scopeWhereContentId($query, $id)
    {
        return $query->where('content_id', $id)->orderBy('created_at');
    }
}
