<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'writer_id', 'borrower_id', 'cover', 'pdf'];

    public function writer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'writer_id');
    }

    public function borrower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'borrower_id');
    }

    // public static function createBook(array $data)
    // {
    //     return self::create($data);

    // }
    // public static function updateBook($id, array $data)
    // {
    //     $Book = self::find($id);
    //     if ($Book) {
    //         $Book->update($data);
    //         return $Book;
    //     }

    //     return null;
    // }
    // public static function deleteBook($id)
    // {
    //     $Book = self::find($id);
    //     if ($Book) {
    //         $Book->delete();
    //         return true;
    //     }

    //     return false;
    // }

    // public static function getBooksByUser($userId)
    // {
    //     return self::where('borrower_id', $userId)->get();
    // }

    // public static function getBookByTitle($title)
    // {
    //     return self::where('title', $title)->first();
    // }
}
