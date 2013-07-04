<? 
if(isset($_GET['order_id']) && isset($_GET['token'])){
		$token_key=strip_tags($_GET['token']);
		$order_id=strip_tags($_GET['order_id']);
		$client_id=strip_tags($_SESSION['client_id']);
		
		if($tb_page_token->math("COUNT","token_key='$token_key' AND status='available'")>0){
			$tb_page_orders->delete("order_id=$order_id AND client_id=$client_id");
			
			$tb_page_token->delete("token_key='$token_key'");
			$tb_page_token->insert(md5(date("Y.m.d.H.i.s.")).rand(1,10000),"available");
		}
	}
?>