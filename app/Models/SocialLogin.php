<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SocialLogin.
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereProvider($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereProviderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SocialLogin whereUserId($value)
 * @mixin \Eloquent
 */
class SocialLogin extends Model
{
    protected $fillable = ['user_id', 'provider', 'provider_id'];
}
