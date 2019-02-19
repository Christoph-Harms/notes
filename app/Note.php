<?php
/**
 * Created by IntelliJ IDEA.
 * User: chensink
 * Date: 2019-02-12
 * Time: 13:05
 */

namespace App;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Note represents a note in the database
 *
 * @property int    $id   The unique id of the note
 * @property string $text The text stored in the note
 * @property string $type The type of the note. One of ['primary', 'info', 'success', 'warning', 'danger']. Determines the color of the note.
 *
 * @mixin Model
 * @mixin Builder
 */
class Note extends Model
{
    protected $fillable = ['text', 'type'];
}
