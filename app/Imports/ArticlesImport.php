<?php

namespace App\Imports;

//use App\Article; //舊的要刪除
use App\Models\Article;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ArticlesImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Article([
            'title'     => $row['title'],
            'content'   => $row['content'],
            'state'     => $row['state'],
            'user_id'   => $row['user_id'],
        ]);
    }
}
