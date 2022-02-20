<?php
session_start();
include_once'../config/master.inc.php';
include_once ROOT_PATH.'config/connection.php';

$created_by=$_SESSION['user_id'];
$timestamp = date("Y-m-d H:i:s");

if(isset($_POST["submit"]) && !empty($_POST['post_id'])) 
{
	extract($_POST);
    $final_posts=[];
    if(strlen($post_id)>0){
        $post_url="//www.instagram.com/p/".$post_id;
        $post_img="//instagram.com/p/".$post_id."/media/?size=t";
        $final_posts['post_url']=$post_url;
        $final_posts['post_img']=$post_img;
    }
    $final_posts=json_encode($final_posts);
	$data=[
		":posts"=>$final_posts
	];

	$columns="";
	$cols=array_keys($data);
	$cols=implode(", ",  $cols);
	$insertCols=str_replace(":", "", $cols);

		try
		{	
			$sql = "INSERT INTO insta_posts ($insertCols) VALUES ($cols);";
			$q= $conn->prepare($sql);

			if($q->execute($data))	
			{
			    $insta_posts="SELECT posts FROM insta_posts ORDER BY id DESC;";
                $insta_posts = $conn->query($insta_posts);
                $insta_posts=$insta_posts->fetchAll(PDO::FETCH_ASSOC);
                if(count($insta_posts)>6)
                {
                    $delete= $conn->prepare("DELETE FROM insta_posts ORDER BY id ASC LIMIT 1;");
                    $delete->execute();
                }
				$_SESSION['s']="Post Added Successfully !!!";
				header('Location:'.ROOT_URL.'add_instagram_post.php');
			}
			else
			{
				$_SESSION['e']="Failed To Add Post !!!";
				echo"<script>history.go(-1);</script>";
			}
		}
		catch (PDOException $ex) 
		{
			echo  $ex->getMessage();
		}
}
?>