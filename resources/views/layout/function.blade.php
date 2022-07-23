<?php 

function subcategory ($category,$id)
{
    echo "<div class='dropdown-menu'>";
    echo "<ul class='uk-list sub-menu'>";
    foreach ($category as $item) 
    {
        if($item['parent'] == $id)
        {
            echo "<li><a href='".$item['slug']."'>".$item['name']."</a>";
            $count = DB::table('tbl_category')->where('parent',$item->id)->count();
            if($count>0) { subcategory($category,$item['id']); }
            echo "</li>";
        }
    }
    echo "</ul>";
    echo "</div>"; 
}

function catchuoi($str, $length, $minword = 3)
{
    $sub = '';
    $len = 0;
    foreach (explode(' ', $str) as $word)
    {
        $part = (($sub != '') ? ' ' : '') . $word;
        $sub .= $part;
        $len += strlen($part);
        if (strlen($word) > $minword && strlen($sub) >= $length)
        {
            break;
        }
    }
    return $sub . (($len < strlen($str)) ? ' ...' : '');
}




?>