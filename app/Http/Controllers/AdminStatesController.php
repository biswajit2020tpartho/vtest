<?php namespace App\Http\Controllers;

	use Session;
	use Request;
	use DB;
	use CRUDBooster;
	use \Cviebrock\EloquentSluggable\Services\SlugService;
	use App\Models\SeoUrl;
	use App\Models\State;
	use Illuminate\Support\Facades\Route;

	class AdminStatesController extends \crocodicstudio\crudbooster\controllers\CBController {

	    public function cbInit() {

			# START CONFIGURATION DO NOT REMOVE THIS LINE
			$this->title_field = "state_name";
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
			$this->table = "states";
			# END CONFIGURATION DO NOT REMOVE THIS LINE

			# START COLUMNS DO NOT REMOVE THIS LINE
			$this->col = [];
			$this->col[] = ["label"=>"Image","name"=>"image","image"=>true];	
			$this->col[] = ["label"=>"Country Name","name"=>"country_id","join"=>"countries,country_name"];
			$this->col[] = ["label"=>"State Name","name"=>"state_name"];
			$this->col[] = [
					"label"=>"Status",
					"name"=>"status",
					"callback_php"	=>'($row->status) ? "Active" : "Inactive"'
				];
			# END COLUMNS DO NOT REMOVE THIS LINE

			# START FORM DO NOT REMOVE THIS LINE
			$this->form = [];
			$this->form[] = ['label'=>'Country','name'=>'country_id','type'=>'select','validation'=>'required|integer|min:0','width'=>'col-sm-10','datatable'=>'countries,country_name->en'];
			$this->form[] = ['label'=>'State Name','name'=>'state_name','type'=>'text','validation'=>'required|min:1|max:255|unique:states','width'=>'col-sm-10'];
			$this->form[] = ['label'=>'Image','name'=>'image','type'=>'upload','validation'=>'required|image|max:3000','width'=>'col-sm-10','help'=>'File types support : JPG, JPEG, PNG, GIF, BMP'];
			$this->form[] = ['label'=>'Show in Home','name'=>'show_in_home','type'=>'select2','validation'=>'required|integer','width'=>'col-sm-10','dataenum'=>'1|Yes;0|No'];
			$this->form[] = [
				'label'=>'Status',
				'name'=>'status',
				'type'=>'select',
				'validation'=>'required|integer',
				'width'=>'col-sm-10',
				'dataenum'		=>'1|Active;0|Inactive'
			];
			# END FORM DO NOT REMOVE THIS LINE

			# OLD START FORM
			//$this->form = [];
			//$this->form[] = ["label"=>"Country Id","name"=>"country_id","type"=>"select2","required"=>TRUE,"validation"=>"required|integer|min:0","datatable"=>"country,id"];
			//$this->form[] = ["label"=>"State Name","name"=>"state_name","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
			//$this->form[] = ["label"=>"Status","name"=>"status","type"=>"text","required"=>TRUE,"validation"=>"required|min:1|max:255"];
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

	        $this->index_button[] = ['label'=>'Add State','url'=>CRUDBooster::mainpath("add"),"icon"=>"fa fa-print"];

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
	        $this->script_js = "
	        	$( document ).ready(function() {
				    $('#btn_add_new_data').text('Add State');
				});
	        ";


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
	    	if($column_index == 2){
	    		$column_value = json_decode($column_value)->en;
	    		return $column_value;
	    	}
	    }

	    /*
	    | ---------------------------------------------------------------------- 
	    | Hook for manipulate data input before add data is execute
	    | ---------------------------------------------------------------------- 
	    | @arr
	    |
	    */
	    public function hook_before_add(&$postdata) {        
	        $request = Request::all();	
	        $slug = SlugService::createSlug(SeoUrl::class, 'slug',$request['state_name']);

         	$seo = SeoUrl::create([
                                "slug"  => $slug,
                                "model" => "App\Models\State",
                                "created_at" => date('Y-m-d, H:i:s')
                            ]);
         	

         	
          	$request['seo_url_id'] = $seo->id;      
          	$request['image'] = $postdata['image'];
	        $country = State::create($request);
	        CRUDBooster::redirect($request['return_url'],"State Added !", "success");


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
	        $request = Request::all();   
	        $slug = SlugService::createSlug(SeoUrl::class, 'slug',$request['state_name']);
	        $row = DB::table($this->table)->where($this->primary_key, $id)->first();
	        if(is_null($row->seo_url_id)){
	        	$seo = SeoUrl::create([
                                "slug"  => $slug,
                                "model" => "App\Models\State",
                                "created_at" => date('Y-m-d, H:i:s')
                            ]);

	        	$state = State::findOrFail($id);
	        	$state['seo_url_id'] = $seo->id;
		        $request['image']      = $postdata['image'];
		      //  dd($postdata['image']);
		        $state->update($request);
		        CRUDBooster::redirect($request['return_url'],"state Updated !", "success");
	        }else{
	        	$state = State::findOrFail($id);
		        $request['image'] = $postdata['image'];
		        //dd($postdata['image']);
		      
		        $state->update($request);
		        CRUDBooster::redirect($request['return_url'],"State Updated !", "success");
	        }	

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


	    public function getDetail($id)	{
			$this->cbLoader();
			$row        = DB::table($this->table)->where($this->table.".id",$id)->first();
			 // dd($row );

			if(!CRUDBooster::isRead() && $this->global_privilege==FALSE || $this->button_detail==FALSE) {
				CRUDBooster::insertLog(trans("crudbooster.log_try_view",['name'=>$row->{$this->title_field},'module'=>CRUDBooster::getCurrentModule()->name]));
				CRUDBooster::redirect(CRUDBooster::adminPath(),trans('crudbooster.denied_access'));
			}

			$module     = CRUDBooster::getCurrentModule();

			$page_menu  = Route::getCurrentRoute()->getActionName();
			$page_title = trans("crudbooster.detail_data_page_title",
				['module'=>$module->name,
				'name'=>$row->{$this->title_field}
			    ]
			);

			$details = [];

			$country = DB::table('countries')
	    				->where('countries'.".id", $row->country_id)->first();

        	array_push($details, [
        			'field_name' => 'Country Name',
        			'data' =>json_decode($country->country_name)->en
        	]);

        	array_push($details, [
        		'field_name' => 'Name', 
        		'data' => $row->state_name,
        	]);

			array_push($details, [
        		'field_name' => 'Status', 
        		'data' => ($row->status) ? 'Active' : 'Inactive'
        	]);

        	array_push($details, [
        		'field_name' => 'Show in home', 
        		'data' => ($row->show_in_home) ? 'Yes' : 'No'
        	]);
			return view('CRUDBooster.getDetail', compact('details', 'page_title', 'page_menu'));
			// Session::put('current_row_id',$id);

			// return view('crudbooster::default.form',compact('row','page_menu','page_title','command','id'));
		}

	    //By the way, you can still create your own method in here... :) 


	}