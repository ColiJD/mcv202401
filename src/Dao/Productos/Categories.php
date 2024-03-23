<?php

namespace Dao\Productos;

use Dao\Table;

class Categories extends Table
{
    public static function getAllCategories()
    {
        $sqlstr = 'SELECT * FROM categories;';

        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getCategory($categoryId)
    {
        $sqlstr = 'SELECT * FROM categories WHERE category_id = :category_id;';

        return self::obtenerRegistros($sqlstr, ['category_id' => $categoryId]); /* el self hace referencia a la tabla table */
    }

    public static function getCategoryWithFilet($categoryName)
    {
        $sqlstr = 'SELECT * FROM categories WHERE category_name LIKE :category_name; ';

        return self::obtenerRegistros($sqlstr, ['category_name' => '%'.$categoryName.'%']);
    }

    public static function insertCategory(
        $categoryName,
        $categorySmallDesc,
        $categoryStatus, )
    {
        $sqlstr = 'INSERT INTO categories(category_name,category_small_desc,category_status)
      VALUES(:category_name,:category_small_desc,:category_status);';

        return self::executeNonQuery(
            $sqlstr, [
              'category_name' => $categoryName,
              'category_small_desc' => $categorySmallDesc,
              'category_status' => $categoryStatus,
            ]
        );
    }

    public static function updateCategory(
        $categoryName,
        $categorySmallDesc,
        $categoryStatus,
        $categoryId)
    {
        $sqlstr = 'UPDATE categories SET category_name = :category_name, 
          category_small_desc =:category_small_desc,
          category_status=:category_status
          WHERE category_id=:category_id;';

        return self::executeNonQuery(
            $sqlstr, [
              'category_name' => $categoryName,
              'category_small_desc' => $categorySmallDesc,
              'category_status' => $categoryStatus,
              'category_id' => $categoryId,
            ]
        );
    }

    public static function deleteCategory($categoryId)
    {
        $sqlstr = 'DELETE FROM categories WHERE category_id =:category_id;';

        return self::executeNonQuery($sqlstr, ['category_id' => $categoryId]);
    }
}
