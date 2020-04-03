<?php

namespace App\Http\Controllers;
use Auth;
use App\DailyScrum;
use App\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DailyScrumController extends Controller
{
    public function index(){
    	try{
	        $data["count"] = DailyScrum::count();
	        $daily = array();
	        $dataDaily = DB::table('dailyscrum')->join('users','users.id','=','dailyscrum.id_users')
                                               ->select('dailyscrum.id', 'users.Firstname','users.Lastname','users.email', 
                                               'dailyscrum.team','dailyscrum.id_users','dailyscrum.activity_yesterday',
                                               'dailyscrum.activity_today','dailyscrum.problem_yesterday','dailyscrum.solution')
	                                           ->get();

	        foreach ($dataDaily as $p) {
	            $item = [
	                "id"          		    => $p->id,
                    "id_users"              => $p->id_users,
	                "Firstname"  		    => $p->Firstname,
	                "Lastname"  			=> $p->Lastname,
	                "email"    	  		    => $p->email,
	                "team"  		        => $p->team,
                    "activity_yesterday"  	=> $p->activity_yesterday,
                    "activity_today"  	    => $p->activity_today,
	                "problem_yesterday"	    => $p->problem_yesterday,
                    "solution"              => $p->solution,
	            ];

	            array_push($daily, $item);
	        }
	        $data["daily"] = $daily;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function getAll($limit = 10, $offset = 0, $id_users)
    {
    	try{
	        $data["count"] = DailyScrum::count();
	        $daily = array();
	        $dataDaily = DB::table('dailyscrum')->join('users','users.id','=','dailyscrum.id_users')
                                               ->select('dailyscrum.id', 'users.Firstname','users.Lastname','users.email', 
                                               'dailyscrum.team','dailyscrum.id_users','dailyscrum.activity_yesterday',
                                               'dailyscrum.activity_today','dailyscrum.problem_yesterday','dailyscrum.solution')
                                               ->skip($offset)
                                               ->take($limit)
                                               ->where('dailyscrum.id_users', $id_users)
	                                           ->get();

	        foreach ($dataDaily as $p) {
	            $item = [
                    "id"          		    => $p->id,
                    "id_users"              => $p->id_users,
	                "Firstname"  		    => $p->Firstname,
	                "Lastname"  			=> $p->Lastname,
	                "email"    	  		    => $p->email,
	                "team"  		        => $p->team,
                    "activity_yesterday"  	=> $p->activity_yesterday,
                    "activity_today"  	    => $p->activity_today,
	                "problem_yesterday"	    => $p->problem_yesterday,
                    "solution"              => $p->solution,
	            ];

	            array_push($daily, $item);
	        }
	        $data["daily"] = $daily;
	        $data["status"] = 1;
	        return response($data);

	    } catch(\Exception $e){
			return response()->json([
			  'status' => '0',
			  'message' => $e->getMessage()
			]);
      	}
    }

    public function store(Request $request)
    {
      try{
    		$validator = Validator::make($request->all(), [
    			'team'                  => 'required|string|max:255',
				'activity_yesterday'	=> 'required|string|max:255',
                'activity_today'  		=> 'required|string|max:500',
                'problem_yesterday'	 	=> 'required|string|max:255',
				'solution'	      		=> 'required|string|max:500',
    		]);

    		if($validator->fails()){
    			return response()->json([
    				'status'	=> 0,
    				'message'	=> $validator->errors()
    			]);
            }
            
    //cek apakah ada id user tersebut
            if(User::where('id', $request->input('id_users'))->count() > 0){
                    $data = new DailyScrum();
                    $data->id_users = $request->input('id_users');
                    $data->team = $request->input('team');
                    $data->activity_yesterday = $request->input('activity_yesterday');
                    $data->activity_today = $request->input('activity_today');
                    $data->problem_yesterday = $request->input('problem_yesterday');
                    $data->solution = $request->input('solution');
                    $data->save();

            return response()->json([
                'status'	=> '1',
                'message'	=> 'Data daily  berhasil ditambahkan!'
            ], 201);
            } else {
                return response()->json([
                    'status' => '0',
                    'message' => 'Data users tidak ditemukan.'
                ]);
            }

    

} catch(\Exception $e){
    return response()->json([
        'status' => '0',
        'message' => $e->getMessage()
    ]);;
        }
  	}

      public function delete($id)
      {
          try{
  
              $delete = DailyScrum::where("id", $id)->delete();
              if($delete){
                return response([
                  "status"  => 1,
                    "message"   => "Data daily scrum berhasil dihapus."
                ]);
              } else {
                return response([
                  "status"  => 0,
                    "message"   => "Data daily scrum gagal dihapus."
                ]);
              }
              
          } catch(\Exception $e){
              return response([
                  "status"	=> 0,
                  "message"   => $e->getMessage()
              ]);
          }
      }
  
      public function getDetailDaily($id)
    {
    	try {

    		$dataDaily = Siswa::where('id', $id)->first();
        if($dataDaily != NULL){
      		$detailDailyScrum = DB::table('dailyScrum')->join('users','users.id','=','dailyscrum.id_users')
                                                ->select('dailyscrum.id', 'users.Firstname','users.Lastname','users.email', 
                                                'dailyscrum.team','dailyscrum.id_users','dailyscrum.activity_yesterday',
                                                'dailyscrum.activity_today','dailyscrum.problem_yesterday','dailyscrum.solution')
                                                ->where('dailyscrum.id_users', $id_user)
                                                ->get();

      		
      		$data["team"] = $dataDaily->team;
  	        $data["activity_yesterday"] 		= $dataDaily->activity_yesterday;
  	        $data["activity_today"] 		= $dataDaily->activity_today;
            $data["problem_yesterday"] 		= $dataDaily->problem_yesterday;
            $data["solution"] 		    = $dataDaily->solution;
              
  	        $detailDaily = array();
  	        foreach ($detailDailyScrum->get() as $p) {

  	            $item = [
	                "team"  		        => $p->team,
                    "activity_yesterday"  	=> $p->activity_yesterday,
                    "activity_today"  	    => $p->activity_today,
	                "problem_yesterday"	    => $p->problem_yesterday,
                    "solution"              => $p->solution,
  	            ];

  	            array_push($detailDaily, $item);
  	        }

  	        $data["detail"] = $detailDaily;
  	        $data["count"] 	= $detailDailyScrum->get()->count();
  	        $data["status"] = 1;
  	        return response($data);
          } else {
            return response([
              'status' => 0,
              'message' => 'Data user tidak ditemukan'
            ]);
          }

    	} catch(\Exception $e){
    		return response([
    			'status' => 0,
    			'message' => $e->getMessage()
    		]);
    	}
    }

}
