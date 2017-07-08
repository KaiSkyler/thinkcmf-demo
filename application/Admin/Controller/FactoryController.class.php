<?php
namespace Admin\Controller;

use Common\Controller\AdminbaseController;

class FactoryController extends AdminbaseController{
	//factory审核
	public function audit(){
		$Area = M('Area');
		$areaList = $Area->where('is_delete=0')->select();
		$this->assign('areaList',$areaList);

		$Industry = M('Industry');
		$industryList = $Industry->where('is_delete=0')->select();
		$this->assign('industryList',$industryList);

        $Address = M('Address');
        $addressList = $Address->where('is_delete=0')->select();
        $this->assign('addressList',$addressList);

		$House_test = M('House_test');
		$where['is_delete'] = 0;
		$where['is_audit'] = 2;

		$count=$House_test->where($where)->count();
        $page = $this->page($count, 10);

		$auditList = $House_test->where($where)->order("id DESC")->limit($page->firstRow , $page->listRows)->select();

		$j=1;
        //给查询的数据增加logo字段
        foreach($auditList as $key => $value) {
            $auditList[$key]['sort_id']=$page->firstRow+$j;
            $j++;
        }

        //讲分页信息传到页面
        $this->assign("page", $page->show('Admin'));

		$this->assign('auditList',$auditList);
		$this->display();
	}

	//审核厂房列表检索
	public function audit_sel(){

		$Area = M('Area');
		$areaList = $Area->where('is_delete=0')->select();
		$this->assign('areaList',$areaList);

		$Industry = M('Industry');
		$industryList = $Industry->where('is_delete=0')->select();
		$this->assign('industryList',$industryList);

        $Address = M('Address');
        $addressList = $Address->where('is_delete=0')->select();
        $this->assign('addressList',$addressList);

		$where['is_audit']=2;
        $where['is_delete']=0;

      $select_address=I('request.address');
        if($select_address!='0'){
            $where['house_area']=$select_address;
        }
        $this->assign("select_address",$select_address);


        $select_industry=I('request.industry');
        if($select_industry!='0'){
            $where['house_type']=$select_industry;
        }
        $this->assign("select_industry",$select_industry);

        $select_fac_area=I('request.fac_area');
        if($select_fac_area!='0'){
            $where['house_mianji']=$select_fac_area;
        }
        $this->assign("select_area",$select_fac_area);

        //获取输入内容
        $select_keyword=I('request.keyword');
        if($select_keyword!=null && $select_keyword!=''){
            $where['house_user|house_phone']=array('like','%'.$select_keyword.'%');
        }
        $this->assign("select_keyword",$select_keyword);

        $House_test = M('House_test');
        $count=$House_test->where($where)->count();
        $page = $this->page($count, 10);
        $auditList = $House_test->where($where)->order("id DESC")->limit($page->firstRow , $page->listRows)->select();

        $j=1;
        //给查询的数据增加logo字段
        foreach($auditList as $key => $value) {

            $auditList[$key]['sort_id']=$page->firstRow+$j;
            $j++;
        }

        //讲分页信息传到页面
        $this->assign("page", $page->show('Admin'));
		$this->assign('auditList',$auditList);
		$this->display('audit');
	}

	//factory列表
	public function factory_list(){
		$Area = M('Area');
		$areaList = $Area->where('is_delete=0')->select();
		$this->assign('areaList',$areaList);

		$Industry = M('Industry');
		$industryList = $Industry->where('is_delete=0')->select();
		$this->assign('industryList',$industryList);

        $Address = M('Address');
        $addressList = $Address->where('is_delete=0')->select();
        $this->assign('addressList',$addressList);

		$House_test = M('House_test');
		$where['is_delete'] = 0;
		$where['is_audit'] = 0;

		$count=$House_test->where($where)->count();
        $page = $this->page($count, 10);
		$factoryList = $House_test->where($where)->order("id DESC")->limit($page->firstRow , $page->listRows)->select();


        $j=1;
        //给查询的数据增加logo字段
        foreach($factoryList as $key => $value) {
            $factoryList[$key]['sort_id']=$page->firstRow+$j;
            $j++;
        }

        //讲分页信息传到页面
        $this->assign("page", $page->show('Admin'));

		$this->assign('factoryList',$factoryList);

		$this->display();
	}

	//厂房列表列表检索
	public function factory_sel(){

		$Area = M('Area');
		$areaList = $Area->where('is_delete=0')->select();
		$this->assign('areaList',$areaList);

		$Industry = M('Industry');
		$industryList = $Industry->where('is_delete=0')->select();
		$this->assign('industryList',$industryList);

        $Address = M('Address');
        $addressList = $Address->where('is_delete=0')->select();
        $this->assign('addressList',$addressList);

		$where['is_audit']=0;
        $where['is_delete']=0;

        $select_address=I('request.address');
        if($select_address!='0'){
            $where['house_area']=$select_address;
        }
        $this->assign("select_address",$select_address);


        $select_industry=I('request.industry');
        if($select_industry!='0'){
            $where['house_type']=$select_industry;
        }
        $this->assign("select_industry",$select_industry);

        $select_fac_area=I('request.fac_area');
        if($select_fac_area!='0'){
            $where['house_mianji']=$select_fac_area;
        }
        $this->assign("select_area",$select_fac_area);

        //获取输入内容
        $select_keyword=I('request.keyword');
        if($select_keyword!=null && $select_keyword!=''){
            $where['house_user|house_phone']=array('like','%'.$select_keyword.'%');
        }
        $this->assign("select_keyword",$select_keyword);

        $House_test = M('House_test');
        $count=$House_test->where($where)->count();
        $page = $this->page($count, 10);
		$factoryList = $House_test->where($where)->order("id DESC")->limit($page->firstRow , $page->listRows)->select();

        $j=1;
        //给查询的数据增加logo字段
        foreach($factoryList as $key => $value) {
            $factoryList[$key]['sort_id']=$page->firstRow+$j;
            $j++;
        }
        //讲分页信息传到页面
        $this->assign("page", $page->show('Admin'));

		$this->assign('factoryList',$factoryList);
		$this->display('factory_list');
	}

	//添加厂房
	public function add_factory(){

		if(IS_POST){
            foreach ($_POST['images'] as $key=>$value)
            {
                $base64_body = substr(strstr($value,','),1);
                $data=base64_decode($base64_body);
                $uniName=md5(uniqid(microtime(true),true)).'.jpg';
                file_put_contents("upload/".$uniName,$data);
                $img[] = $uniName;
            }

	    	$info['house_name']=$_POST['fac_name'];
			$info['house_mianji']=$_POST['fac_area'];
			$info['house_create']=$_POST['lease_time'];
			$info['house_address']=$_POST['xx_address'];
			$info['house_area']=$_POST['address'];
			$info['house_type']=$_POST['fac_use'];
			$info['house_user']=$_POST['name'];
			$info['house_phone']=$_POST['phone'];
	    	$info['house_pic']=json_encode($img);
	    	$info['is_audit']=2;

	    	$House_test=M('House_test');
			$count=$House_test->add($info);
			if($count){
				$this->ajaxReturn(1);
			}else{
				$this->ajaxReturn(0);
			}

		}else{

			$Area = M('Area');
			$areaList = $Area->where('is_delete=0')->select();
			$this->assign('areaList',$areaList);

			$Industry = M('Industry');
			$industryList = $Industry->where('is_delete=0')->select();
			$this->assign('industryList',$industryList);

            $Address = M('Address');
            $addressList = $Address->where('is_delete=0')->select();
            $this->assign('addressList',$addressList);
		}
		$this->display();
	}

	//审核厂房详情
	public function detail(){

		$id = $_GET['id'];
		$House_test = M('House_test');
		$detail=$House_test->where('id='.$id)->select();
        $images = json_decode($detail[0]['house_pic'],true);
        $this->assign('detail',$detail);
        $this->assign('images',$images);
		$this->display();
	}

	//审核通过厂房详情
	public function detailList(){
		$id = $_GET['id'];
		$House_test = M('House_test');
		$detail=$House_test->where('id='.$id)->select();

        $this->assign('detail',$detail);
		$this->display();
	}

	//厂房审核通过
    public function pass(){

        $id=$_POST['id'];
        $House_test=M('House_test');
        $count=$House_test->where('id='.$id)->setField('is_audit',0);
        if($count){
            //审核通过
            $this->ajaxReturn(1);
        }else{
            //操作失败
            $this->ajaxReturn(0);
        }
    }


    //厂房审核不通过
    public function dispass(){

        $id=$_POST['id'];
        $House_test=M('House_test');
        $count=$House_test->where('id='.$id)->setField('is_audit',1);
        if($count){
            //审核不通过
            $this->ajaxReturn(1);
        }else{
            //操作失败
            $this->ajaxReturn(0);
        }
    }

    //删除已经审核通过的厂房
    public function delete(){

    	$id=$_POST['id'];
        $House_test=M('House_test');
        $count=$House_test->where('id='.$id)->setField('is_delete',1);
        if($count){
            //删除成功
            $this->ajaxReturn(1);
        }else{
            //删除失败
            $this->ajaxReturn(0);
        }

    }
}