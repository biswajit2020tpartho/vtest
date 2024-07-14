<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;

	class AdminAdvertisementsListController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "title";
			$this->limit = "20";
			$this->orderby = "id,desc";
			$this->global_privilege = false;
			$this->button_table_action = true;
			$this->button_bulk_action = true;
			$this->button_action_style = "button_icon";
			$this->button_add = true;
			$this->button_edit = true;
			$this->button_delete = true;
			$this->button_detail = true;
			$this->button_show = true;
			$this->button_filter = true;
			$this->button_import = false;
			$this->button_export = false;
			$this->table = "advertisements";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			// $this->col[] = ["label"=>"User Id","name"=>"user_id","join"=>"user,id"];
			$this->col[] = ["label"=>"Title","name"=>"title"];
			$this->col[] = ["label"=>"Images","name"=>"images","image"=>"true"];
			$this->col[] = ["label"=>"Category","name"=>"cat_id","join"=>"categories,name->en"];
			$this->col[] = ["label"=>"Short Description","name"=>"short_description"];
			$this->col[] = ["label"=>"Status","name"=>"status","callback_php"=>'($row->status==1) ? Active : Inactive'];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Title','name'=>'title','type'=>'text','validation'=>'required|string|min:3|max:70','width'=>'col-sm-10','placeholder'=>'You can only enter the letter only'];
			$this->form[] = ['label'=>'Images','name'=>'images','type'=>'upload','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'countries,country_name->en'];
			$this->form[] = ['label'=>'State','name'=>'state_id','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'states,state_name','parent_select'=>'country_id'];
			$this->form[] = ['label'=>'City','name'=>'city_id','type'=>'select','validation'=>'required|min:1|max:255','width'=>'col-sm-10','datatable'=>'citys,city_name','parent_select'=>'state_id'];
			$this->form[] = ['label'=>'Short Description','name'=>'short_description','type'=>'textarea','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Description','name'=>'description','type'=>'wysiwyg','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Category','name'=>'cat_id','type'=>'select','validation'=>'required','width'=>'col-sm-10','datatable'=>'categories,name->en','datatable_where'=>'status=true'];
			$this->form[] = ['label'=>'Amount','name'=>'amount','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
						
			$this->form[] = ['label'=>'Is Featured','name'=>'is_featured','type'=>'select','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'1|Yes;0|No'];
			$this->form[] = ['label'=>'Status','name'=>'status','type'=>'select','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'1|Active;0|Inactive'];
			$this->form[] = ['label'=>'Approved','name'=>'approved','type'=>'select','validation'=>'required','width'=>'col-sm-10','dataenum'=>'1|Approved;0|Disapproved'];
			$this->form[] = ['label'=>'Expair At','name'=>'expair_at','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Rating','name'=>'rating','type'=>'text','validation'=>'required|min:1|max:255','width'=>'col-sm-10'];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"User Id","name"=>"user_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"user,id"];
			//$this->form[] = ["label"=>"Title","name"=>"title","type"=>"text","required"=>TRUE,"validation"=>"required|string|min:3|max:70","placeholder"=>"You can only enter the letter only"];
			//$this->form[] = ["label"=>"Images","name"=>"images","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Country Id","name"=>"country_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"country,id"];
			//$this->form[] = ["label"=>"State Id","name"=>"state_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"state,id"];
			//$this->form[] = ["label"=>"City Id","name"=>"city_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"city,id"];
			//$this->form[] = ["label"=>"Short Description","name"=>"short_description","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Description","name"=>"description","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"View","name"=>"view","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Approved","name"=>"approved","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Cat Id","name"=>"cat_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"cat,id"];
			//$this->form[] = ["label"=>"Amount","name"=>"amount","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Seo Url Id","name"=>"seo_url_id","type"=>"select2","required"=>TRUE,"validation"=>"required|min:1|max:255","datatable"=>"seo_url,id"];
			//$this->form[] = ["label"=>"Is Featured","name"=>"is_featured","type"=>"radio","required"=>TRUE,"validation"=>"required|integer","dataenum"=>"Array"];
			//$this->form[] = ["label"=>"Expair At","name"=>"expair_at","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Rating","name"=>"rating","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			# OLD END FORM

			/* 
	        | ---------------------------------------------------------------------- 
	        | Sub Module
	        | ----------------------------------------------------------------------     
			| @label          = Label of action 
			| @path           = Path of sub module
			| @foreign_key 	  = foreign key of sub table/module
			| @button_color   = Bootstrap Class (primary,success,warning,danger)
			| @button_icon    = Font Awesome Class  
			| @parent_columns = Sparate with comma, e.g : name,created_at
	        | 
	        */
	        $this->sub_module = array();
	        $this->sub_module[] = ['label'=>'Images','path'=>'advertisements_image','parent_columns'=>'title','foreign_key'=>'ads_id','button_color'=>'primary','button_icon'=>'fa fa-image text-normal'];
	        $this->sub_module[] = ['label'=>'Review','path'=>'advertisement_reviws','parent_columns'=>'title','foreign_key'=>'ads_id','button_color'=>'primary','button_icon'=>'fa fa-street-view'];
	        $this->sub_module[] = ['label'=>'Amenties','path'=>'advertisement_amenties','parent_columns'=>'title','foreign_key'=>'ads_id','button_color'=>'primary','button_icon'=>'fa fa-building'];


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Action Button / Menu
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @url         = Target URL, you can use field alias. e.g : [id], [name], [title], etc
	        | @icon        = Font awesome class icon. e.g : fa fa-bars
	        | @color 	   = Default is primary. (primary, warning, succecss, info)     
	        | @showIf 	   = If condition when action show. Use field alias. e.g : [id] == 1
	        | 
	        */
	        $this->addaction = array();


	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add More Button Selected
	        | ----------------------------------------------------------------------     
	        | @label       = Label of action 
	        | @icon 	   = Icon from fontawesome
	        | @name 	   = Name of button 
	        | Then about the action, you should code at actionButtonSelected method 
	        | 
	        */
	        $this->button_selected = array();

	                
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add alert message to this module at overheader
	        | ----------------------------------------------------------------------     
	        | @message = Text of message 
	        | @type    = warning,success,danger,info        
	        | 
	        */
	        $this->alert        = array();
	                

	        
	        /* 
	        | ---------------------------------------------------------------------- 
	        | Add more button to header button 
	        | ----------------------------------------------------------------------     
	        | @label = Name of button 
	        | @url   = URL Target
	        | @icon  = Icon from Awesome.
	        | 
	        */
	        $this->index_button = array();



	        /* 
	        | ---------------------------------------------------------------------- 
	        | Customize Table Row Color
	        | ----------------------------------------------------------------------     
	        | @condition = If condition. You may use field alias. E.g : [id] == 1
	        | @color = Default is none. You can use bootstrap success,info,warning,danger,primary.        
	        | 
	        */
	        $this->table_row_color = array();     	          

	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | You may use this bellow array to add statistic at dashboard 
	        | ---------------------------------------------------------------------- 
	        | @label, @count, @icon, @color 
	        |
	        */
	        $this->index_statistic = array();



	        /*
	        | ---------------------------------------------------------------------- 
	        | Add javascript at body 
	        | ---------------------------------------------------------------------- 
	        | javascript code in the variable 
	        | $this->script_js = "function() { ... }";
	        |
	        */
	        $this->script_js = NULL;


            /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code before index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it before index table
	        | $this->pre_index_html = "<p>test</p>";
	        |
	        */
	        $this->pre_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include HTML Code after index table 
	        | ---------------------------------------------------------------------- 
	        | html code to display it after index table
	        | $this->post_index_html = "<p>test</p>";
	        |
	        */
	        $this->post_index_html = null;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include Javascript File 
	        | ---------------------------------------------------------------------- 
	        | URL of your javascript each array 
	        | $this->load_js[] = asset("myfile.js");
	        |
	        */
	        $this->load_js = array();
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Add css style at body 
	        | ---------------------------------------------------------------------- 
	        | css code in the variable 
	        | $this->style_css = ".style{....}";
	        |
	        */
	        $this->style_css = NULL;
	        
	        
	        
	        /*
	        | ---------------------------------------------------------------------- 
	        | Include css File 
	        | ---------------------------------------------------------------------- 
	        | URL of your css each array 
	        | $this->load_css[] = asset("myfile.css");
	        |
	        */
	        $this->load_css = array();
	        
	        
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for button selected
	    | ---------------------------------------------------------------------- 
	    | @id_selected = the id selected
	    | @button_name = the name of button
	    |
	    */
	    public function actionButtonSelected($id_selected,$button_name) {
	        //Your code here
	            
	    }


	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate query of index result 
	    | ---------------------------------------------------------------------- 
	    | @query = current sql query 
	    |
	    */
	    public function hook_query_index(&$query) {
	        //Your code here
	            
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate row of index table html 
	    | ---------------------------------------------------------------------- 
	    |
	    */    
	    public function hook_row_index($column_index,&$column_value) {	        
	    	//Your code here
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after add public static function called 
	    | ---------------------------------------------------------------------- 
	    | @id = last insert id
	    | 
	    */
	    public function hook_after_add($id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before update data is execute
	    | ---------------------------------------------------------------------- 
	    | @postdata = input post data 
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_edit(&$postdata,$id) {        
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after edit public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_edit($id) {
	        //Your code here 

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command before delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_before_delete($id) {
	        //Your code here

	    }

	    /* 
	    | ---------------------------------------------------------------------- 
	    | Hook for execute command after delete public static function called
	    | ----------------------------------------------------------------------     
	    | @id       = current id 
	    | 
	    */
	    public function hook_after_delete($id) {
	        //Your code here

	    }



	    //By the way, you can still create your own method in here... :) 


	}