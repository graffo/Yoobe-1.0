<?php
/*
	Template name: Fluxo Produtos
	*/

get_header();

 ?>

	<div id="primary" class="content-area produtos-custom">
		<main id="main" class="site-main" role="main">
			<div class="container">
				<div class="row">
			

			<?php
	

/*$p_name= wp_unique_post_slug('jaqueta-college-7',83482,'publish','product',0);
$my_post = array();
        $my_post['ID'] = 83482;
        $my_post['post_name'] = $p_name;
        wp_update_post( $my_post );
		*/

	
/*
$arr[0] = "1578|||1578_7_1585770651.png";
//$arr[1] = "1808|||1808_7_1585770654.png";

$str="[\"1578|||IMAGIK|||%7B+%09%22moc_provider_ext_id%22%3A%5B%222%22%5D%2C+%09%22print_attr%22%3A%7B+%09%09%22image_size%22%3A%22100%25+auto%22%2C+%09%09%22image_position%22%3A%22center+center%22%2C+%09%09%22width%22%3A%22medium%22+%09%09+%09%7D+%09+%7D\",\"1808|||IMAGIK|||%7B+%09%22moc_provider_ext_id%22%3A%5B%2235%22%5D%2C+%09%22print_attr%22%3A%7B+%09%09%22image_size%22%3A%22100%25+auto%22%2C+%09%09%22image_position%22%3A%22center+center%22%2C+%09%09%22width%22%3A%22medium%22+%09%09+%09%7D+%09+%7D\"]
";
$arr2=json_decode($str);
$prod_com_img=array();
foreach($arr as $x){
	$pr_id=explode('|||',$x)[0];
	$pr_img=explode('|||',$x)[1];
	$prod_com_img[$pr_id]=$pr_img;
}

foreach($arr2 as $a){
	echo explode('|||',$a)[0]."<br>";
	$pr_id=explode('|||',$a)[0];
	$arr_prod_copiar[]=array("id"=>$pr_id,"img"=>$prod_com_img[$pr_id] );
}

print_r($arr_prod_copiar);
//print_r(json_decode($str));

exit();*/
/* 

 
    'test_form' => false
);
 */
 //$uploadedfile = $_FILES['file'];
 //print_r($_FILES);

$usuario_logado=13;

$fullUrlBase='https://yoobe.co/wp-content/uploads/users/'.$usuario_logado;
$userUrlBase='uploads/users/'.$usuario_logado;



/*
$baseDir= dirname( __FILE__ ).'\\..\\..' ;
//$uploaddir = 'C:\\xampp\\htdocs\\newcorp\\newcorp\\wp-content\\uploads\\2020\\04\\';
$uploaddir = $baseDir.'\\uploads\\users\\'.$usuario_logado.'\\';
$finalFileName="";
if(isset($_FILES['file'])){
	$finalFileName=time().'_'.basename($_FILES['file']['name']);
}
$uploadfile = $uploaddir .'\\'.$finalFileName ;
criaDir($baseDir.'\\uploads\\users\\');
criaDir($baseDir.'\\uploads\\users\\'.$usuario_logado);
*/


$baseDir= dirname( __FILE__ ).'/../..' ;
//$uploaddir = 'C:\\xampp\\htdocs\\newcorp\\newcorp\\wp-content\\uploads\\2020\\04\\';
$uploaddir = $baseDir.'/uploads/users/'.$usuario_logado.'/';
$finalFileName="";
if(isset($_FILES['file'])){
	$finalFileName=time().'_'.basename($_FILES['file']['name']);
}
$uploadfile = $uploaddir .'/'.$finalFileName ;
criaDir($baseDir.'/uploads/users/');
criaDir($baseDir.'/uploads/users/'.$usuario_logado);



function criaDir($uploaddir){
	if( is_dir($uploaddir) ){

	}else{
		mkdir($uploaddir, 0755, true);
	}
	return true;

}
if(isset($_FILES['file'])){
	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
		//echo "Arquivo válido e enviado com sucesso.\n";
	} else {
		//echo "Possível ataque de upload de arquivo!\n";
	}
}
$fullUrl_externo=$fullUrlBase.'/';

// exit(0);
 /*
if(isset($_FILES['file']))
    {
	$uploadedfile = $_FILES['file'];
				
		$movefile = wp_handle_upload( $uploadedfile,array('test_form' => FALSE) );
		 print_r($movefile);
		if ( $movefile && ! isset( $movefile['error'] ) ) {
			echo __( 'File is valid, and was successfully uploaded.', 'textdomain' ) . "\n";
			var_dump( $movefile );
		} else {
			
			echo $movefile['error'];
		}
	echo"aa";
		print_r($_FILES);
		//exit(0);
	}
	
	*/
//upd_sku($wpdb,63906,'63894');


//exit();


//geracao da imagem
//$produto_criado=83466;
//$dir='2020/03';
//$file='college.png';
//$imgMeta=genImageMeta($dir,$file);
//$prod_copiar=1808;
//print_r(serialize($imgMeta));

//*
//echo"post img ";
 //$post_image=83473; //createImage($wpdb,'http://yoobe.co/wp-content/uploads/2020/03/college.png',$dir,$file,7,$prod_copiar);
//createImage($wpdb,'http://yoobe.co/wp-content/uploads/2020/03/college.png',$dir,$file,7,$prod_copiar);
/*
update_post_meta( $produto_criado, '_thumbnail_id', $post_image );
update_post_meta( $produto_criado, '_product_image_gallery', $post_image );


update_post_meta( $post_image, '_wp_attachment_metadata', $imgMeta );
update_post_meta( $post_image, '_wp_attached_file', $dir.'/'.$file );
update_post_meta( $post_image, 'original-file', $dir.'/'.$file );
update_post_meta( $post_image, '_wp_attachment_image_alt', $dir.'/'.$file );
*/
//*/
//echo ' foi?';
function createImage($db,$fullurl,$dir,$file,$author,$prod_copiar){
	
	$res= $db->get_results("SELECT * FROM `wp_postmeta` m join wp_posts p on p.id=m.meta_value where post_id='".$prod_copiar."' and meta_key='_thumbnail_id' limit 1");
	
	foreach($res as $r){
		 $query="
			INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, 
			`post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) 
			VALUES (NULL, '".$author."', '".$r->post_date."', '".$r->post_date_gmt."', '".$r->post_content."', '".$r->post_title."', '".$r->post_excerpt."', 'inherit', 'open', 'closed', '', '".$r->post_name."-".$author."-".time()."', '', '', 
			'".$r->post_modified."', '".$r->post_modified_gmt."', '', '0', 	'".$fullurl."', '0', 'attachment', 'image/png', '0');
			";
	}
	$db->query(
        $db->prepare($query)
	 );
	$i_id=$db->insert_id;
	genPostName($db,$i_id);
	return $i_id;
	
	/*$query="
	INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, 
	`post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) 
	VALUES (NULL, '".$author."', '2020-03-31 16:43:33', '2020-03-31 19:43:33', 'Jaqueta College Front', 'Jaqueta College Front', 'Jaqueta College Front', 'inherit', 'open', 'closed', '', 'jaqueta-college-".$author."', '', '', 
	'2020-01-14 16:44:42', '2020-01-14 19:44:42', '', '0', 	'".$fullurl."', '0', 'attachment', 'image/png', '0');
	";*/
	/*$db->query(
        $db->prepare($query)
	 );
	return $db->insert_id;
	*/
}






/*

echo "criação do produto	";	
$prod_copiar=1808;
$id_author=7;




//*
//$id_novo_produto=63894;
echo "novo produto ".$id_novo_produto=cop_prod($wpdb,$prod_copiar,$id_author,0);
cop_post_meta($wpdb,$prod_copiar,$id_novo_produto);

upd_stock_meta($id_novo_produto);

genVariantes($wpdb,$prod_copiar,$id_novo_produto);
cop_terms($wpdb,$prod_copiar,$id_novo_produto);

//*/

//exit(0);			
			
/*
$pr = WC_Product($product_id);
$pr->wc_get_product();
$all_products = $pr->wc_get_product($args); */


//echo "uuuu";
//exit();

$prods=getAvailableProducts($wpdb);

$arrProd=array();


if( !isset($_POST["prod"]) && !isset($_POST["prod_img"]) ) {?>



<form method=post name=formulario  enctype="multipart/form-data">
	
	<div class="jumbotron">
		<h2 class="display-4">Seja bem vindo a Customização de Produto Yoobe</h2>
		<p class="lead">Aqui você irá definir e customizar os primeiros produtos de sua loja</p>
		<hr class="my-4">
		<h3><span class="badge badge-secondary">1º Passo:</span> Selecione uma imagem para aplicar nos seus futuros produtos</h3>
		<p><input type="file" name="file" id="file"/></p>
	</div>
	
	

	<?php foreach($prods as $p){
		if( !empty($p->prod_print_attributes) ){
			$attr=urlencode($p->prod_print_attributes);
		}
		$arrProd[]=$p->ID;
		echo '<br><input type=checkbox name=prod[] value="'. ($p->ID) .'|||'.$p->prod_mockup_type.'|||'.$attr.'"> <img src="https://yoobe.co/wp-content/uploads/'.$p->meta_value.'" width="70px" /> '. $p->post_title . ' ( '. $p->price .' )';
	}
	echo '<br>
	<input type=submit value=OK>
	</form>';	



}

function  getAvailableProducts($db){
	
	//$wpdb= new wpdb();
	//and post_status='publish'
	$results = $db->get_results( "
	SELECT m2.meta_value ,p.ID,p.post_title,p.post_name,m3.meta_value price
		   ,u.prod_mockup_type,u.prod_print_attributes
	  FROM wp_posts p 
	  join wp_postmeta m on m.meta_key ='_thumbnail_id' AND m.post_id = p.ID
	  join wp_postmeta m2 on m2.meta_key ='_wp_attached_file' AND m2.post_id = m.meta_value
	  join wp_postmeta m3 on m3.meta_key ='_price' AND m3.post_id = p.ID
	  left join ub_products u on u.prod_post_id=p.ID 
	 where p.post_author=3 and p.post_type='product' 
	 
	" );
	//pp($results);
	return $results;
}
	

if(isset($_POST["prod"])){
	
	//print_r($_POST["prod"]);
	//$img_url="https://static.vecteezy.com/system/resources/previews/000/193/547/non_2x/vector-coffee-shop-logo-template.jpg";
	$img_url=$fullUrlBase.'/'.$finalFileName;
	//$img_url="http://yoobe.co/wp-content/uploads/users/7/1585765645_00e241cd-877f-4c76-ac7f-422344029eaf.png";
	
	echo" Todos os produtos escolhidos ficarão disponíveis para enviar as artes 
	<br>mais tarde, para alguns deles geramos a com imagem enviada por você. 
	<br>Escolha os que quiser incluir em seu catalogo.";
	echo"<form method=post name=form2  enctype=\"multipart/form-data\">";
	$all_prod=array();
	foreach($_POST["prod"] as $pr){
		$arrProd=explode('|||',$pr);
		$all_prod[]=$arrProd[0];
		//print_r($arrProd);
		//gera mockups
		
		if($arrProd[1]=='SMARTMOCKUP'){
			//echo urldecode($arrProd[2]);
			$prod_at=json_decode(urldecode($arrProd[2]) );
			if($prod_at){
				//print_r($prod_at);
				$res = smartmockup($img_url,$prod_at);
				$_uploadedName=$arrProd[0].'_'.$usuario_logado.'_'.time().'.png';
				foreach($res as $r){
					echo '<img src="'.$r.'" width="300px" />';
					
					//grab_image($r,$uploaddir.'\\'.$_uploadedName);
					grab_image($r,$uploaddir.'/'.$_uploadedName);
				}
				
			}
			
			echo "<br>";
			
		}elseif($arrProd[1]=='IMAGIK'){
			$prod_at=json_decode(urldecode($arrProd[2]) );
			if($prod_at){
				$res = imagik($img_url,$prod_at);
				$_uploadedName=$arrProd[0].'_'.$usuario_logado.'_'.time().'.png';
				foreach($res as $r){
					echo '<img src="'.$r.'" width="300px" />';
					
					//grab_image($r,$uploaddir.'\\'.$_uploadedName);
					grab_image($r,$uploaddir.'/'.$_uploadedName);
				}
			}
		}
		echo '<br><input type=checkbox name=prod_img[] value="'. ($arrProd[0]) .'|||'.$_uploadedName.''.''.'"> ';
		
	}
	$str_all_prods=implode(',',$all_prod);
	//$json_prod=json_encode($_POST["prod"]);
	echo "<br><input type=hidden name='p_allprods' value='".$str_all_prods."' />";
	echo"<input type=submit value='Continuar' >";
	echo"</form>";
	
}

if(isset($_POST["prod_img"])){
	/*echo"<pre>";
	print_r($_POST["prod_img"]);
	print_r(explode(',',$_POST["p_allprods"]));
	echo"</pre>";
	*/
	
	
	$arr_prod_copiar=getArrayCopiar($_POST["p_allprods"],$_POST["prod_img"] );
	//print_r($arr_prod_copiar);
	//echo"vai começar copiar";
	foreach($arr_prod_copiar as $prod){
		echo "Copiando produto ".$prod["id"]."<br>";
		//$produto_criado=83466;
		$prod_copiar=$prod["id"];
		$id_novo_produto=cop_prod($wpdb,$prod_copiar,$usuario_logado,0);
		echo  "Produto criado ".$id_novo_produto;
		echo"<br>";
		if($id_novo_produto>0) {
		
			cop_post_meta($wpdb,$prod_copiar,$id_novo_produto);

			upd_stock_meta($id_novo_produto);

			genVariantes($wpdb,$prod_copiar,$id_novo_produto,$usuario_logado);
			cop_terms($wpdb,$prod_copiar,$id_novo_produto);

			setPostPublicado($id_novo_produto);
			
			if( !empty($prod["img"]) ){
				echo "Copiar imagem ".$prod["img"]."<br>";
				
				
				//geracao da imagem
				
				$dir='users/'.$usuario_logado;
				$file=''.$prod["img"];
				$imgMeta=genImageMeta($dir,$file);
				$prod_copiar=$prod["id"];
				//print_r(serialize($imgMeta));

				//*
				//echo"post img ";
				// $post_image=83473; 
				 $post_image=createImage($wpdb,'https://yoobe.co/wp-content/uploads/users/'.$usuario_logado.'/'.$prod["img"],$dir,$file,$usuario_logado,$prod_copiar);
				if( $post_image>0 ){
				
					//createImage($wpdb,'http://yoobe.co/wp-content/uploads/2020/03/college.png',$dir,$file,7,$prod_copiar);
					
					//*
					update_post_meta( $id_novo_produto, '_thumbnail_id', $post_image );
					update_post_meta( $id_novo_produto, '_product_image_gallery', $post_image );


					update_post_meta( $post_image, '_wp_attachment_metadata', $imgMeta );
					update_post_meta( $post_image, '_wp_attached_file', $dir.'/'.$file );
					update_post_meta( $post_image, 'original-file', $dir.'/'.$file );
					update_post_meta( $post_image, '_wp_attachment_image_alt', $dir.'/'.$file );
					//*/
				
				}
			}
		}else{
			echo "Nao foi possivel criar o produto";
		}
	}
	echo"<p><a href='https://yoobe.co/store/graffo'>Visitar loja (yoobe.co/store/graffo)</a> ";
	
}



function getArrayCopiar($str,$arr){
	//echo "dentro ";
	$arr2=explode(',',$_POST["p_allprods"]); //json_decode(urldecode($str),true);
	
	//print_r($arr2);
	
	//echo"deeeee ";
	$prod_com_img=array();
	foreach($arr as $x){
		$pr_id=explode('|||',$x)[0];
		$pr_img=explode('|||',$x)[1];
		$prod_com_img[$pr_id]=$pr_img;
	}
	$arr_prod_copiar=array();
	foreach($arr2 as $a){
		//echo explode('|||',$a)[0]."<br>";
		$pr_id=$a;
		$arr_prod_copiar[]=array("id"=>$pr_id,"img"=>$prod_com_img[$pr_id] );
	}
	//print_r($prod_com_img);
	//print_r($arr_prod_copiar);
	return $arr_prod_copiar;
	
	
}

function grab_image($url,$saveto){
	$ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw=curl_exec($ch);
    curl_close ($ch);
    if(file_exists($saveto)){
        unlink($saveto);
    }
    $fp = fopen($saveto,'x');
    fwrite($fp, $raw);
    fclose($fp);
}

/*
lista todas as varações de um produto 

$arrProd=array(1601);
$args = [
    'status'    => 'publish',
    'orderby' => 'name',
    'order'   => 'ASC',
    'limit' => -1,
	'include' => $arrProd
];

$all_products = wc_get_products($args);
echo"<pre>";
foreach ($all_products as $key => $product) {
    echo $product->get_title();
	print_r($product);
    if ($product->get_type() == "variable") {
        print_r($product->get_variation_attributes());
		foreach ($product->get_variation_attributes() as $variations) {
            foreach ($variations as $variation) {
                echo $product->get_title() . " - " . $variation;
				echo"<br>";
				
            }
        }
    }
	echo "<p>";
}
echo"</pre>";
*/
			

/*

criação de produto usando funcoes do wp

$item = array(
    'Name' => 'Product A',
    'Description' => 'This is a product A',
    'SKU' => '10020030A',
);
$user_id = get_current_user(); // this has NO SENSE AT ALL, because wp_insert_post uses current user as default value
// $user_id = $some_user_id_we_need_to_use; // So, user is selected..
$post_id = wp_insert_post( array(
    'post_author' => 7,
    'post_title' => $item['Name'].'_7',
    'post_content' => $item['Description'],
    'post_status' => 'publish',
    'post_type' => "product",
) );
wp_set_object_terms( $post_id, 'simple', 'product_type' );
update_post_meta( $post_id, '_visibility', 'visible' );
update_post_meta( $post_id, '_stock_status', 'instock');
update_post_meta( $post_id, 'total_sales', '0' );
update_post_meta( $post_id, '_downloadable', 'no' );
update_post_meta( $post_id, '_virtual', 'yes' );
update_post_meta( $post_id, '_regular_price', '' );
update_post_meta( $post_id, '_sale_price', '' );
update_post_meta( $post_id, '_purchase_note', '' );
update_post_meta( $post_id, '_featured', 'no' );
update_post_meta( $post_id, '_weight', '' );
update_post_meta( $post_id, '_length', '' );
update_post_meta( $post_id, '_width', '' );
update_post_meta( $post_id, '_height', '' );
update_post_meta( $post_id, '_sku', $item['SKU'] );
update_post_meta( $post_id, '_product_attributes', array() );
update_post_meta( $post_id, '_sale_price_dates_from', '' );
update_post_meta( $post_id, '_sale_price_dates_to', '' );
update_post_meta( $post_id, '_price', '' );
update_post_meta( $post_id, '_sold_individually', '' );
update_post_meta( $post_id, '_manage_stock', 'no' );
update_post_meta( $post_id, '_backorders', 'no' );
update_post_meta( $post_id, '_stock', '' );

echo "inserido ".$post_id;
*/



function genImageMeta($dir,$file){
	// dir: 2020/03 
	$metaSerialized=array (
	  'width' => 1000,
	  'height' => 1000,
	  'file' => $dir.'/'.$file,
	  'sizes' => 
	  array (
		'woocommerce_thumbnail' => 
		array (
		  'file' => $file,
		  'width' => 300,
		  'height' => 375,
		  'mime-type' => 'image/png',
		  'uncropped' => false,
		),
		'woocommerce_gallery_thumbnail' => 
		array (
		  'file' => $file,
		  'width' => 100,
		  'height' => 100,
		  'mime-type' => 'image/png',
		),
		'woocommerce_single' => 
		array (
		  'file' => $file,
		  'width' => 500,
		  'height' => 500,
		  'mime-type' => 'image/png',
		),
		'medium' => 
		array (
		  'file' => $file,
		  'width' => 300,
		  'height' => 300,
		  'mime-type' => 'image/png',
		),
		'thumbnail' => 
		array (
		  'file' => $file,
		  'width' => 150,
		  'height' => 150,
		  'mime-type' => 'image/png',
		),
		'medium_large' => 
		array (
		  'file' => $file,
		  'width' => 768,
		  'height' => 768,
		  'mime-type' => 'image/png',
		),
		'quadron-570-hard' => 
		array (
		  'file' => $file,
		  'width' => 750,
		  'height' => 372,
		  'mime-type' => 'image/png',
		),
		'quadron-184-hard' => 
		array (
		  'file' => $file,
		  'width' => 260,
		  'height' => 200,
		  'mime-type' => 'image/png',
		),
		'twentyseventeen-thumbnail-avatar' => 
		array (
		  'file' => $file,
		  'width' => 100,
		  'height' => 100,
		  'mime-type' => 'image/png',
		),
		'shop_catalog' => 
		array (
		  'file' => $file,
		  'width' => 300,
		  'height' => 375,
		  'mime-type' => 'image/png',
		  'uncropped' => false,
		),
		'shop_single' => 
		array (
		  'file' => $file,
		  'width' => 500,
		  'height' => 500,
		  'mime-type' => 'image/png',
		),
		'shop_thumbnail' => 
		array (
		  'file' => $file,
		  'width' => 100,
		  'height' => 100,
		  'mime-type' => 'image/png',
		),
		'woocommerce_thumbnail_preview' => 
		array (
		  'file' => $file,
		  'width' => 262,
		  'height' => 328,
		  'mime-type' => 'image/png',
		),
	  ),
	  'image_meta' => 
	  array (
		'aperture' => '0',
		'credit' => '',
		'camera' => '',
		'caption' => '',
		'created_timestamp' => '0',
		'copyright' => '',
		'focal_length' => '0',
		'iso' => '0',
		'shutter_speed' => '0',
		'title' => '',
		'orientation' => '0',
		'keywords' => 
		array (
		),
	  ),
	);

	return ($metaSerialized);
}


/****
	 FUNCOES DE DUPLICACAO DE PRODUTO
***/
//63894 63906  upd_sku(63894,63906);

function upd_sku($db,$meta_post_id,$str_sku){
	
	$sku=''.$str_sku;
	if($meta_post_id>0){
		$size=get_metadata( 'post', $meta_post_id,  'attribute_pa_size',  true );
		if( !empty(trim($size)) ) {
			$sku=''.$sku.'-'.$size;
		}
	}
	if( !empty($sku) ){
		update_post_meta( $meta_post_id, '_sku', $sku );
	}
	return $sku;

}
function genVariantes($db,$prod_copiar,$id_novo_produto,$usuario_logado){
	
	$res= $db->get_results("select * from wp_posts where post_parent='".$prod_copiar."' and post_type='product_variation' ");
	echo "select * from wp_posts where post_parent='".$prod_copiar."' and post_type='product_variation' ";
	foreach( $res as $r){
		echo '<br>Copiar variante '.$r->ID.' ';
		
		//insere produto variante
		$id_novo_post_variante=cop_prod($db,$r->ID,$usuario_logado,$id_novo_produto);
		
		cop_post_meta($db,$r->ID,$id_novo_post_variante);
		upd_stock_meta($id_novo_post_variante);
	}
	
}

function cop_post_meta($db,$de,$para){
	
	$query="insert into wp_postmeta (post_id,meta_key,meta_value) select $para,meta_key,meta_value from wp_postmeta where post_id=$de";
	//echo "<br>";
	$db->query(
        $db->prepare($query)
	 );
	return $db->insert_id;
}

function cop_terms($db,$de,$para){
	
	$query="insert into wp_term_relationships SELECT $para,term_taxonomy_id,term_order FROM wp_term_relationships where object_id = $de";
	$db->query(
        $db->prepare($query)
	 );
	//echo "SELECT $para,term_taxonomy_id,term_order FROM `wp_term_relationships` where object_id = $de";
	//echo "<br>";
	
}

function upd_stock_meta($post_id){
	update_post_meta( $post_id, '_manage_stock', 'no' );
	update_post_meta( $post_id, '_stock_status', 'instock' );
}
/*
_manage_stock
no


_stock_status
instock
update_post_meta( $post_id, '_manage_stock', 'no' );
update_post_meta( $post_id, '_stock_status', 'instock' );
*/

function cop_prod($db,$prod_copiar,$id_author,$parent=0){

	
	$query=" 
		INSERT INTO wp_posts 
		( post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, post_name, to_ping, pinged, post_modified, 
		post_modified_gmt, post_content_filtered, post_parent, guid, menu_order, post_type, post_mime_type, comment_count)
		select ".$id_author." as post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, comment_status, ping_status, post_password, 
		concat(post_name,'-".$id_author."') post_name , to_ping, pinged, post_modified, post_modified_gmt, post_content_filtered, '".$parent."', concat(guid,'-".$id_author."') guid, menu_order, post_type, 
		post_mime_type, comment_count from wp_posts where id='".$prod_copiar."'

	";
	 $db->query(
        $db->prepare($query)
	 );
	 
	 
	 $id_inserido=$db->insert_id;
	 genPostName($db,$id_inserido);
	 
	
	 
	 
	return $id_inserido;
}


function genPostName($db,$prod)
{

	$results = $db->get_results( "
		SELECT post_name,post_type from wp_posts where ID='".$prod."'
	" );
	//print_r($results);
	foreach($results as $r){
		$post_name=$r->post_name;
		$type=$r->post_type;
	}
	
	
	$p_name_novo= wp_unique_post_slug($post_name,$prod,'publish',$type,0);
	
	$my_post = array();
	$my_post['ID'] = $prod;
	$my_post['post_name'] = $p_name_novo.'';
	wp_update_post( $my_post );
	
}

function setPostPublicado($id_novo_produto){
	$my_post = array();
	$my_post['ID'] = $id_novo_produto;
	$my_post['post_status'] = 'publish';
	wp_update_post( $my_post );
}

function smartmockup($img_url,$specs){
	$img_res=array();
	foreach($specs->moc_provider_ext_id as $s){
		//echo " gen ".$s;
		$img_res[]= gen_smartmockup($s,$img_url);
	}
	return $img_res;
}

function imagik($img_url,$specs){
	$img_res=array();
	foreach($specs->moc_provider_ext_id as $s){
		//echo " gen ".$s;
		$img_res[]= gen_imagik($s,$img_url);
	}
	return $img_res;
}



function gen_smartmockup($mockup_id,$arquivos3){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://public-api.smartmockups.com/v1/mockups/$mockup_id",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "", 
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS =>"{\n    \"image_url\": \"$arquivos3\",\n    \"width\": \"medium\",\n    \"image_size\": \"100% auto\",\n    \"image_position\": \"center center\"\n   \n}",
	CURLOPT_HTTPHEADER => array(
		"x-api-key: Pa8quOpvNa7koLqz2ooKc4WkBlXBl2nW4mo0Xfnn",
		"Content-Type: application/json"
	  ),
	));

	$response = curl_exec($curl);
	curl_close($curl);
	$json_output = json_decode($response, true);

	$url=  $json_output['src'];
	return $url;
}
function gen_imagik($mockup_id,$arquivos3){
	$curl = curl_init();
	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://yoobe.me/mocgen/supersecret/",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "", 
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 0,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_POSTFIELDS =>"{\n    \"img\": \"$arquivos3\",\n \"mockup\": \"$mockup_id\",\n    \"width\": \"medium\",\n    \"image_size\": \"100% auto\",\n    \"image_position\": \"center center\"\n   \n}",
	CURLOPT_HTTPHEADER => array(
		"x-api-key: supersecret",
		"Content-Type: application/json"
	  ),
	));
//echo "aaa";
	$response = curl_exec($curl);
	curl_close($curl);
	$json_output = json_decode($response, true);
	//print_r($response);
	 $url=  $json_output['src'];
	return $url;
}



			
			/*
			while ( have_posts() ) :
				the_post();

				do_action( 'storefront_page_before' );

				get_template_part( 'content', 'page' );

				
				do_action( 'storefront_page_after' );

			endwhile; 
			*/
			?>
			</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//do_action( 'storefront_sidebar' );
get_footer();
