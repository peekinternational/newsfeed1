<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use DateTime;
use Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      //$allcount=DB::table('wingg_app_post')->count();

      $user_id=$request->session()->get('chat_admin')->id;
      // dd($user_id);
      //   $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
      //   ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
      //   ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
      //   ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
      //   ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
      //   ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
      //   ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->paginate(10);
      //  $usercount=$posts->count();
      // $company_id=$request->session()->get('chat_admin')->company_id;
      //       // dd($get_date .'/'. $getcurrentday);
      //        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
      //        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
      //        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
      //        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
      //        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
      //        ->where('wingg_app_post.company_id','=',$company_id)->where('wingg_app_post.id','<',36858)->get();
      //        // dd($posts);
      //        foreach ($posts as &$post) {
      //          DB::table('wingg_app_postteam')->where('post_id',$post->id)->delete();
      //          DB::table('wingg_app_postposition')->where('post_id',$post->id)->delete();
      //          DB::table('wingg_app_post')->where('id',$post->id)->delete();
      //        }
        return view('admin.news');
    }

    public function showPosts(Request $request)
    {
        $date = $_GET['date'];
      //dd($date);
      if ($date !="") {
        $getcurrentday = date("Y-m-d h:i:s");
        if ($date == "today") {
          $gettoday = date("Y-m-d");
          // dd($gettoday);
        }
        if ($date == "1 day") {
          $get_date = date('Y-m-d h:i:s', strtotime('-1 day', strtotime($getcurrentday)));
        }elseif ($date == '1 week') {
          $get_date = date('Y-m-d h:i:s', strtotime('-1 week', strtotime($getcurrentday)));
        }elseif ($date == '15 days') {
          $get_date = date('Y-m-d h:i:s', strtotime('-15 days', strtotime($getcurrentday)));
        }elseif ($date == '1 month') {
          $get_date = date('Y-m-d h:i:s', strtotime('-1 month', strtotime($getcurrentday)));
        }elseif ($date == '6 month') {
          $get_date = date('Y-m-d h:i:s', strtotime('-6 month', strtotime($getcurrentday)));
        }elseif ($date == '1 year') {
          $get_date = date('Y-m-d h:i:s', strtotime('-1 year', strtotime($getcurrentday)));

        }
      }
      // dd($get_date);
$user_id=$request->session()->get('chat_admin')->id;
$company_id=$request->session()->get('chat_admin')->company_id;
      // dd($get_date .'/'. $getcurrentday);
       $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
       ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
       ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
       ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
       ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
       ->where('wingg_app_post.company_id','=',$company_id);

       if ($date =='today' && $gettoday !='') {
         // $gettoday ='2020-02-13';
         $posts->where('wingg_app_post.created_at','like','%'.$gettoday.'%');
       }elseif ($get_date != '' && $getcurrentday != '') {
         $posts->whereBetween('wingg_app_post.created_at',[$get_date, $getcurrentday]);
       }
       $posts=$posts->orderby('wingg_app_post.created_at','desc')->paginate(20);
    //  dd($posts);

         $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
         ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
         ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
         ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
         ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
         ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
         ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();
        $totalcount=$posts2->count();
       $total = count($posts->items());
       //dd($totalcount);
       $output='';
       $x=[];
       $output .= '<table class="table">';
       $output .= ' <thead>';
       $output .= '<th colspan="2"></th>';
       $output .= '<th colspan="2">Title</th>';
       $output .= '<th colspan="">Created at</th>';
       $output .= '<th colspan="3">Team</th>';
       $output .= '<th colspan="3">Roles</th>';
       $output .= '<th colspan="3">Targeted Audience</th>';
       $output .= '<th colspan="3">Likes</th>';
       $output .= '<th colspan="3">Dislike</th>';
       $output .= '<th colspan="3">blank_field</th>';
       $output .= '<th colspan="3">blank_field</th>';

       $output .= '</thead>';
       $output .= '<tbody >';
       if(!$posts->isEmpty())
       {
           foreach($posts as $post)
           {
             $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
             if($post->image_url){
                 $cover_image=$post->image_url;
             }else{
               $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
             }
           $text_url = url('dashboard/edit-post-text/'.$post->id);
           $image_url = url('dashboard/edit-post-image/'.$post->id);
           $link_url = url('dashboard/edit-post-link/'.$post->id);
           $delete_url = url('dashboard/deletepost/'.$post->id);
           // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

           $output .= '<tr>';
             $output .= '<td class="action-btn" style="width: 9%;">';
               if($post->media_type == 'text'){
               $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
               }elseif($post->media_type == 'video/pdf'){
               $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
               }elseif($post->media_type == 'link'){
               $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
               }else {
                 $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
               }
               $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
               $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
             $output .= '</td>';
             $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
               $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
             $output .= '</td>';
             $output .= '<td colspan="2"> '.$post->created_at.'</td>';
             $output .= '<td colspan="3"> '.$post->t_name.'</td>';
             $output .= '<td colspan="3"> '.$post->p_name.'</td>';
             $output .= '<td colspan="3"> 2812</td>';
             $output .= '<td colspan="3"> '.$post->likes.'</td>';
             $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
             $output .= '<td colspan="3"> -</td>';
             $output .= '<td colspan="3"> -</td>';
           $output .= '</tr>';
           }
           $output.='</tbody>';
           $output.='  </table>';
           $output.=$posts->render();
           // dd($output);

       }
       $x = array(
         'output' => $output,
         'total' => $total,
         'totalcount' => $totalcount,

     );
       echo json_encode($x);
      // dd($posts);
    //   return view('admin.posts',compact('posts'));
    }
    public function showdatepage(Request $request)
    {

    return view('admin.posts',compact('posts'));
 }


    public function store(Request $request)
    {
        if($request->isMethod('post')){
           // dd($request->all());
        $company_id=$request->session()->get('chat_admin')->company_id;
            $input['title']=$request->input('post_title');
            $input['content']=$request->input('post_description');
            $input['company_id']=$company_id;
            $input['dislikes']=0;
            $input['likes']=0;
            $input['media_type']='text';
            $input['created_at']=  date('Y-m-d H:i:s');
            $input['updated_at']=  date('Y-m-d H:i:s');
             $image = $request->file('cover_image');
//dd($image);
            if ($image !="") {
            $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('cover/images');
            // dd($destinationPath);
            $image->move($destinationPath, $profilePicture);
            $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
            $input['image_url']=$imagepath;
            }
           $post_id=DB::table('wingg_app_post')->insertGetId( $input);

           $team['team_id']=$request->input('team');
           $team['post_id']=$post_id;
           $wingg_app_postteam=DB::table('wingg_app_postteam')->insertGetId($team);

           $position['position_id']=$request->input('role');
           $position['post_id']=$post_id;
           $wingg_app_postposition=DB::table('wingg_app_postposition')->insertGetId($position);
           $request->session()->flash('post', 'Post Create Sussessfully');
            return redirect('/dashboard');
        }
       return view('admin.add-post');
    }

    // Edit text Post
    public function editPost(Request $request, $id)
    {
      // dd($id);
      if($request->isMethod('post')){
        // dd($request->all());
        $company_id=$request->session()->get('chat_admin')->company_id;
        $input['title'] = $request->input('post_title');
        $input['content'] = $request->input('post_description');
        $input['company_id']=$company_id;
        $input['dislikes']=0;
        $input['likes']=0;
        $input['created_at']=  date('Y-m-d H:i:s');
        $input['updated_at']=  date('Y-m-d H:i:s');

        $image = $request->file('cover_image');
        if ($image !="") {
        $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('cover/images');
        $image->move($destinationPath, $profilePicture);
        $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
        $input['cover_image']=$imagepath;
        }
        // dd($input);
        DB::table('wingg_app_post')->where('id', $id)->update($input);

        $wingg_app_postteam=DB::table('wingg_app_postteam')->where('post_id', $id)->first();


        $team['team_id'] = $request->input('team');
        DB::table('wingg_app_postteam')->where('id', $wingg_app_postteam->id)->update($team);

        $wingg_app_postposition=DB::table('wingg_app_postposition')->where('post_id', $id)->first();

        $position['position_id']=$request->input('role');
        DB::table('wingg_app_postposition')->where('id', $wingg_app_postposition->id)->update($position);

        $request->session()->flash('post', 'Post updated Sussessfully');
        return redirect('/dashboard');
      }

      $post=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
      ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
      ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
      ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
      ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
      ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
      ->where('wingg_app_postteam.post_id','=',$id)->first();
      //dd($post);
      return view('admin.edit_post_text', compact('post'));
    }

    // Edit Image Post
    public function editPostImage(Request $request, $id)
    {
        // dd($request->all());
      if($request->isMethod('post')){
        // dd($request->all());
        $company_id=$request->session()->get('chat_admin')->company_id;
        if ($request->input('post_title') !="") {
          $input['title']=$request->input('post_title');
        }
        $input['content']=$request->input('post_description');
        $input['company_id']=$company_id;
        $input['dislikes']=0;
        $input['likes']=0;
        $input['created_at']=  date('Y-m-d H:i:s');
        $input['updated_at']=  date('Y-m-d H:i:s');
         $image = $request->file('cover_image');
         $file = $request->file('file');
//dd($image);
        if ($image !="") {
        $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('cover/images');
        $image->move($destinationPath, $profilePicture);
        $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
        $input['cover_image']=$imagepath;
        }

        if ($file !="") {
        $profilePictures = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $destinationPaths = public_path('cover/images');
        $file->move($destinationPaths, $profilePictures);
        $imagepaths='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePictures;
        $input['image_url']=$imagepaths;
        }
        // dd($input);
       DB::table('wingg_app_post')->where('id', $id)->update($input);

        $wingg_app_postteam=DB::table('wingg_app_postteam')->where('post_id', $id)->first();

        if ($request->input('team') !="") {
          $team['team_id'] = $request->input('team');
        DB::table('wingg_app_postteam')->where('id', $wingg_app_postteam->id)->update($team);
      }

        $wingg_app_postposition=DB::table('wingg_app_postposition')->where('post_id', $id)->first();
        if ($request->input('role') !="") {
          $position['position_id']=$request->input('role');
        DB::table('wingg_app_postposition')->where('id', $wingg_app_postposition->id)->update($position);
      }
        $request->session()->flash('post', 'Post updated Sussessfully');
        return redirect('/dashboard');
      }

      $post=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
      ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
      ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
      ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
      ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
      ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
      ->where('wingg_app_postteam.post_id','=',$id)->first();
      //dd($post);
      return view('admin.edit_post_image', compact('post'));
    }


    // Edit External Link Post
    public function editPostLink(Request $request, $id)
    {
      if($request->isMethod('post')){
        $this->validate($request,[
          'link' => 'required|max:130',
        ]);
        //dd($request->all());
        $company_id=$request->session()->get('chat_admin')->company_id;
        $input['title']=$request->input('post_title');
        $input['media_url']=$request->input('link');
        $input['company_id']=$company_id;
        $input['dislikes']=0;
        $input['likes']=0;
        $input['created_at']=  date('Y-m-d H:i:s');
        $input['updated_at']=  date('Y-m-d H:i:s');
         $image = $request->file('cover_image');
         $file = $request->file('file');
//dd($image);
        if ($image !="") {
        $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('cover/images');
        $image->move($destinationPath, $profilePicture);
        $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
        $input['cover_image']=$imagepath;
        }

        if ($file !="") {
        $profilePictures = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
        $destinationPaths = public_path('cover/images');
        $file->move($destinationPaths, $profilePictures);
        $imagepaths='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePictures;
        $input['image_url']=$imagepaths;
        }

       DB::table('wingg_app_post')->where('id', $id)->update($input);

        $wingg_app_postteam=DB::table('wingg_app_postteam')->where('post_id', $id)->first();


        $team['team_id'] = $request->input('team');
        DB::table('wingg_app_postteam')->where('id', $wingg_app_postteam->id)->update($team);

        $wingg_app_postposition=DB::table('wingg_app_postposition')->where('post_id', $id)->first();

        $position['position_id']=$request->input('role');
        DB::table('wingg_app_postposition')->where('id', $wingg_app_postposition->id)->update($position);
        $request->session()->flash('post', 'Post updated Sussessfully');
        return redirect('/dashboard');
      }

      $post=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
      ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
      ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
      ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
      ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
      ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
      ->where('wingg_app_postteam.post_id','=',$id)->first();
      //dd($post);
      return view('admin.edit_post_link', compact('post'));
    }

public function imagestore(Request $request)
    {
        if($request->isMethod('post')){
         //  dd($request->all());
        $company_id=$request->session()->get('chat_admin')->company_id;
            $input['title']=$request->input('post_title');
            $input['content']=$request->input('post_description');
            $input['company_id']=$company_id;
            $input['dislikes']=0;
            $input['likes']=0;
            $input['media_type']='video/pdf';
            $input['created_at']=  date('Y-m-d H:i:s');
            $input['updated_at']=  date('Y-m-d H:i:s');
             $image = $request->file('cover_image');
             $file = $request->file('file');
//dd($image);
            if ($image !="") {
            $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('cover/images');
            $image->move($destinationPath, $profilePicture);
            $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
            $input['image_url']=$imagepath;
            }

            if ($file !="") {
            $profilePictures = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
            $destinationPaths = public_path('cover/images');
            $file->move($destinationPaths, $profilePictures);
            $imagepaths='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePictures;
            $input['media_url']=$imagepaths;
            }

           $post_id=DB::table('wingg_app_post')->insertGetId( $input);

           $team['team_id']=$request->input('team');
           $team['post_id']=$post_id;
           $wingg_app_postteam=DB::table('wingg_app_postteam')->insertGetId($team);

           $position['position_id']=$request->input('role');
           $position['post_id']=$post_id;
           $wingg_app_postposition=DB::table('wingg_app_postposition')->insertGetId($position);
		   if($wingg_app_postposition){
			   $request->session()->flash('post', 'Post Create Sussessfully');
            //return redirect('/dashboard');
		   }
        }
       return view('admin.add-post');
    }


  public function mediastore(Request $request)
    {
      // dd($request->all());
        if($request->isMethod('post')){
          $this->validate($request,[
            'link' => 'required|max:130',
          ]);
           //dd($request->input());
        $company_id=$request->session()->get('chat_admin')->company_id;
            $input['title']=$request->input('post_title');
            $input['media_url']=$request->input('link');
            $input['company_id']=$company_id;
            $input['dislikes']=0;
            $input['likes']=0;
            $input['media_type']='link';
            $input['created_at']=  date('Y-m-d H:i:s');
            $input['updated_at']=  date('Y-m-d H:i:s');
             $image = $request->file('cover_image');
//dd($image);
            if ($image !="") {
            $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('cover/images');
            $image->move($destinationPath, $profilePicture);
            $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/cover/images/'.$profilePicture;
            $input['image_url']=$imagepath;
            }

           $post_id=DB::table('wingg_app_post')->insertGetId( $input);

           $team['team_id']=$request->input('team');
           $team['post_id']=$post_id;
           $wingg_app_postteam=DB::table('wingg_app_postteam')->insertGetId($team);

           $position['position_id']=$request->input('role');
           $position['post_id']=$post_id;
           $wingg_app_postposition=DB::table('wingg_app_postposition')->insertGetId($position);
            $request->session()->flash('post', 'Post Create Sussessfully');
            return redirect('/dashboard');
        }
       return view('admin.add-post');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  public function deletepost(Request $request,$id)
    {
        DB::table('wingg_app_postteam')->where('post_id',$id)->delete();
        DB::table('wingg_app_postposition')->where('post_id',$id)->delete();
        DB::table('wingg_app_post')->where('id',$id)->delete();
        $request->session()->flash('delnum', 'Post delete Successfully');
        return redirect('/dashboard');
    }



 public function teamsearch(Request $request)
    {
      // dd($request->all());
      $team = $request->input('team');
      $role = $request->input('role');
      $date = $request->input('date');
      $keyword = $request->input('keyword');

      $start_date='';
      $end_date='';
      if ($date !=null) {
        $data = explode(' / ',$date);
        $start_date =$data[0];
        $end_date =$data[1];
      }
      $user_id=$request->session()->get('chat_admin')->id;
        $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();
       $totalcount=$posts2->count();

        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_postteam.team_id','=',$team);
        if ($role !=null) {
          $posts->where('wingg_app_postposition.position_id','=',$role);
        }
        if ($keyword !=null) {
          $posts->where('wingg_app_post.title', 'ilike', '%' . $keyword . '%');
        }
        if ($start_date !='' && $end_date !='') {
          if ($start_date == $end_date) {
            $posts->where('wingg_app_post.created_at','like','%'.$start_date.'%');
          }else {
            $posts->whereBetween('wingg_app_post.created_at',[$start_date, $end_date]);
          }
        }
        $posts=$posts->orderby('wingg_app_post.created_at','desc')->paginate(20);
        $total = count($posts->items());
        //dd($total);
        $output='';
        $x=[];
        $output .= '<table class="table">';
        $output .= ' <thead>';
        $output .= '<th colspan="2"></th>';
        $output .= '<th colspan="2">Title</th>';
        $output .= '<th colspan="">Created at</th>';
        $output .= '<th colspan="3">Team</th>';
        $output .= '<th colspan="3">Roles</th>';
        $output .= '<th colspan="3">Targeted Audience</th>';
        $output .= '<th colspan="3">Likes</th>';
        $output .= '<th colspan="3">Dislike</th>';
        $output .= '<th colspan="3">blank_field</th>';
        $output .= '<th colspan="3">blank_field</th>';

        $output .= '</thead>';
        $output .= '<tbody >';
        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
              $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              if($post->image_url){
                  $cover_image=$post->image_url;
              }else{
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              }
            $text_url = url('dashboard/edit-post-text/'.$post->id);
            $image_url = url('dashboard/edit-post-image/'.$post->id);
            $link_url = url('dashboard/edit-post-link/'.$post->id);
            $delete_url = url('dashboard/deletepost/'.$post->id);
            // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

            $output .= '<tr>';
              $output .= '<td class="action-btn" style="width: 9%;">';
                if($post->media_type == 'text'){
                $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'video/pdf'){
                $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'link'){
                $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }else {
                  $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                }
                $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
              $output .= '</td>';
              $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
              $output .= '</td>';
              $output .= '<td colspan="2"> '.$post->created_at.'</td>';
              $output .= '<td colspan="3"> '.$post->t_name.'</td>';
              $output .= '<td colspan="3"> '.$post->p_name.'</td>';
              $output .= '<td colspan="3"> 2812</td>';
              $output .= '<td colspan="3"> '.$post->likes.'</td>';
              $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
              $output .= '<td colspan="3"> -</td>';
              $output .= '<td colspan="3"> -</td>';
            $output .= '</tr>';
            }
            $output.='</tbody>';
            $output.='  </table>';
            $output.=$posts->render();
            // dd($output);

        }
        $x = array(
          'output' => $output,
          'total' => $total,
          'totalcount' => $totalcount,

      );
        echo json_encode($x);
        //dd($posts);
         // return view('admin.ajaxnews',compact('posts'));
    }
 public function search_ajax_main(Request $request)
    {
      // dd($request->all());
      $user_id=$request->session()->get('chat_admin')->id;
        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->paginate(15);
        $total = count($posts->items());
        //dd($total);
        $totalcount = $posts->total();
        $output='';
        $output .= '<table class="table">';
        $output .= ' <thead>';
        $output .= '<th colspan="2"></th>';
        $output .= '<th colspan="2">Title</th>';
        $output .= '<th colspan="">Created at</th>';
        $output .= '<th colspan="3">Team</th>';
        $output .= '<th colspan="3">Roles</th>';
        $output .= '<th colspan="3">Targeted Audience</th>';
        $output .= '<th colspan="3">Likes</th>';
        $output .= '<th colspan="3">Dislike</th>';
        $output .= '<th colspan="3">blank_field</th>';
        $output .= '<th colspan="3">blank_field</th>';

        $output .= '</thead>';
        $output .= '<tbody >';

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
              $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              if($post->image_url){
                  $cover_image=$post->image_url;
              }else{
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              }
            $text_url = url('dashboard/edit-post-text/'.$post->id);
            $image_url = url('dashboard/edit-post-image/'.$post->id);
            $link_url = url('dashboard/edit-post-link/'.$post->id);
            $delete_url = url('dashboard/deletepost/'.$post->id);
            // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

            $output .= '<tr>';
              $output .= '<td class="action-btn" style="width: 9%;">';
                if($post->media_type == 'text'){
                $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'video/pdf'){
                $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'link'){
                $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }else {
                  $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                }
                $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
              $output .= '</td>';
              $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
              $output .= '</td>';
              $output .= '<td colspan="2"> '.$post->created_at.'</td>';
              $output .= '<td colspan="3"> '.$post->t_name.'</td>';
              $output .= '<td colspan="3"> '.$post->p_name.'</td>';
              $output .= '<td colspan="3"> 2812</td>';
              $output .= '<td colspan="3"> '.$post->likes.'</td>';
              $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
              $output .= '<td colspan="3"> -</td>';
              $output .= '<td colspan="3"> -</td>';
            $output .= '</tr>';
            }
            $output.='</tbody>';
            $output.='  </table>';
            $output.=$posts->render();
        }
        $x = array(
          'output' => $output,
          'total' => $total,
          'totalcount' => $totalcount,

        );
        echo json_encode($x);
         // return view('admin.ajaxnews',compact('posts','total'));
    }


    public function positionsearch(Request $request)
    {
      // dd($request->all());
      $role = $request->input('role');
      $team = $request->input('team');
      $date = $request->input('date');
      $keyword = $request->input('keyword');
      $start_date='';
      $end_date='';
      if ($date !=null) {
        $data = explode(' / ',$date);
        $start_date =$data[0];
        $end_date =$data[1];
      }
      $user_id=$request->session()->get('chat_admin')->id;
        $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();
       $totalcount=$posts2->count();
        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_postposition.position_id','=',$role);
        if ($team !=null) {
          $posts->where('wingg_app_postteam.team_id','=',$team);
      }
        if ($keyword !=null) {
          $posts->where('wingg_app_post.title', 'ilike', '%' . $keyword . '%');
      }
      if ($start_date !='' && $end_date !='') {
        if ($start_date == $end_date) {
          $posts->where('wingg_app_post.created_at','like','%'.$start_date.'%');
        }else {
          $posts->whereBetween('wingg_app_post.created_at',[$start_date, $end_date]);
        }
      }
        $posts=$posts->orderby('wingg_app_post.created_at','desc')->paginate(20);
        $total = count($posts->items());
        //dd($total);

        $output='';
        $output .= '<table class="table">';
        $output .= ' <thead>';
        $output .= '<th colspan="2"></th>';
        $output .= '<th colspan="2">Title</th>';
        $output .= '<th colspan="">Created at</th>';
        $output .= '<th colspan="3">Team</th>';
        $output .= '<th colspan="3">Roles</th>';
        $output .= '<th colspan="3">Targeted Audience</th>';
        $output .= '<th colspan="3">Likes</th>';
        $output .= '<th colspan="3">Dislike</th>';
        $output .= '<th colspan="3">blank_field</th>';
        $output .= '<th colspan="3">blank_field</th>';

        $output .= '</thead>';
        $output .= '<tbody >';

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
              $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              if($post->image_url){
                  $cover_image=$post->image_url;
              }else{
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              }
            $text_url = url('dashboard/edit-post-text/'.$post->id);
            $image_url = url('dashboard/edit-post-image/'.$post->id);
            $link_url = url('dashboard/edit-post-link/'.$post->id);
            $delete_url = url('dashboard/deletepost/'.$post->id);
            // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

            $output .= '<tr>';
              $output .= '<td class="action-btn" style="width: 9%;">';
                if($post->media_type == 'text'){
                $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'video/pdf'){
                $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'link'){
                $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }else {
                  $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                }
                $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
              $output .= '</td>';
              $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
              $output .= '</td>';
              $output .= '<td colspan="2"> '.$post->created_at.'</td>';
              $output .= '<td colspan="3"> '.$post->t_name.'</td>';
              $output .= '<td colspan="3"> '.$post->p_name.'</td>';
              $output .= '<td colspan="3"> 2812</td>';
              $output .= '<td colspan="3"> '.$post->likes.'</td>';
              $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
              $output .= '<td colspan="3"> -</td>';
              $output .= '<td colspan="3"> -</td>';
            $output .= '</tr>';
            }
            $output.='</tbody>';
            $output.='  </table>';
            $output.=$posts->render();
        }
        $x = array(
          'output' => $output,
          'total' => $total,
          'totalcount' => $totalcount,

        );
        echo json_encode($x);
        //dd($posts);
         // return view('admin.ajaxnews',compact('posts'));
    }

    public function datesearch(Request $request)
    {
      // dd($request->all());
      $date = $request->input('date');
      $role = $request->input('role');
      $team = $request->input('team');
      $keyword = $request->input('keyword');
      $start_date='';
      $end_date='';
      if ($date !=null) {
        $data = explode(' / ',$date);
        $start_date =$data[0];
        $end_date =$data[1];
      }
      $user_id=$request->session()->get('chat_admin')->id;
        $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();
       $totalcount=$posts2->count();
        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id');
        if ($start_date == $end_date) {
          $posts->where('wingg_app_post.created_at','like','%'.$start_date.'%');
        }else {
          $posts->whereBetween('wingg_app_post.created_at',[$start_date, $end_date]);
        }
        if ($keyword !=null) {
          $posts->where('wingg_app_post.title', 'ilike', '%' . $keyword . '%');
        }
        if ($role !=null) {
          $posts->where('wingg_app_postposition.position_id','=',$role);
        }
        if ($team !=null) {
          $posts->where('wingg_app_postteam.team_id','=',$team);
        }

        $posts=$posts->orderby('wingg_app_post.created_at','desc')->paginate(20);
        $total = count($posts->items());
        //dd($total);

        $output='';
        $output .= '<table class="table">';
        $output .= ' <thead>';
        $output .= '<th colspan="2"></th>';
        $output .= '<th colspan="2">Title</th>';
        $output .= '<th colspan="">Created at</th>';
        $output .= '<th colspan="3">Team</th>';
        $output .= '<th colspan="3">Roles</th>';
        $output .= '<th colspan="3">Targeted Audience</th>';
        $output .= '<th colspan="3">Likes</th>';
        $output .= '<th colspan="3">Dislike</th>';
        $output .= '<th colspan="3">blank_field</th>';
        $output .= '<th colspan="3">blank_field</th>';

        $output .= '</thead>';
        $output .= '<tbody >';

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
              $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              if($post->image_url){
                  $cover_image=$post->image_url;
              }else{
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              }
            $text_url = url('dashboard/edit-post-text/'.$post->id);
            $image_url = url('dashboard/edit-post-image/'.$post->id);
            $link_url = url('dashboard/edit-post-link/'.$post->id);
            $delete_url = url('dashboard/deletepost/'.$post->id);
            // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

            $output .= '<tr>';
              $output .= '<td class="action-btn" style="width: 9%;">';
                if($post->media_type == 'text'){
                $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'video/pdf'){
                $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'link'){
                $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }else {
                  $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                }
                $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
              $output .= '</td>';
              $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
              $output .= '</td>';
              $output .= '<td colspan="2"> '.$post->created_at.'</td>';
              $output .= '<td colspan="3"> '.$post->t_name.'</td>';
              $output .= '<td colspan="3"> '.$post->p_name.'</td>';
              $output .= '<td colspan="3"> 2812</td>';
              $output .= '<td colspan="3"> '.$post->likes.'</td>';
              $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
              $output .= '<td colspan="3"> -</td>';
              $output .= '<td colspan="3"> -</td>';
            $output .= '</tr>';
            }
            $output.='</tbody>';
            $output.='  </table>';
            $output.=$posts->render();
        }
        $x = array(
          'output' => $output,
          'total' => $total,
          'totalcount' => $totalcount,

        );
        echo json_encode($x);
         // return view('admin.ajaxnews',compact('posts'));
    }

 public function search(Request $request)
    {
        // dd($request->all());
        $keyword = $request->searchkeyword;
        $team = $request->team;
        $role = $request->role;
        $date = $request->date;
        $start_date='';
        $end_date='';
        if ($date !=null) {
          $data = explode(' / ',$date);
          $start_date =$data[0];
          $end_date =$data[1];
        }

        $user_id=$request->session()->get('chat_admin')->id;
          $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
          ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
          ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
          ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
          ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
          ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
          ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();
         $totalcount=$posts2->count();
        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_post.title', 'ilike', '%' . $keyword . '%');
        if ($role !=null) {
          $posts->where('wingg_app_postposition.position_id','=',$role);
        }
        if ($team !=null) {
          $posts->where('wingg_app_postteam.team_id','=',$team);
      }
      if ($start_date !='' && $end_date !='') {
        if ($start_date == $end_date) {
          $posts->where('wingg_app_post.created_at','like','%'.$start_date.'%');
        }else {
          $posts->whereBetween('wingg_app_post.created_at',[$start_date, $end_date]);
        }
      }
        $posts=$posts->orderby('wingg_app_post.created_at','desc')->paginate(20);
        $total = count($posts->items());
        //dd($total);

        $output='';
        $output .= '<table class="table">';
        $output .= ' <thead>';
        $output .= '<th colspan="2"></th>';
        $output .= '<th colspan="2">Title</th>';
        $output .= '<th colspan="">Created at</th>';
        $output .= '<th colspan="3">Team</th>';
        $output .= '<th colspan="3">Roles</th>';
        $output .= '<th colspan="3">Targeted Audience</th>';
        $output .= '<th colspan="3">Likes</th>';
        $output .= '<th colspan="3">Dislike</th>';
        $output .= '<th colspan="3">blank_field</th>';
        $output .= '<th colspan="3">blank_field</th>';

        $output .= '</thead>';
        $output .= '<tbody >';

        if(!$posts->isEmpty())
        {
            foreach($posts as $post)
            {
              $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              if($post->image_url){
                  $cover_image=$post->image_url;
              }else{
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
              }
            $text_url = url('dashboard/edit-post-text/'.$post->id);
            $image_url = url('dashboard/edit-post-image/'.$post->id);
            $link_url = url('dashboard/edit-post-link/'.$post->id);
            $delete_url = url('dashboard/deletepost/'.$post->id);
            // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

            $output .= '<tr>';
              $output .= '<td class="action-btn" style="width: 9%;">';
                if($post->media_type == 'text'){
                $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'video/pdf'){
                $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }elseif($post->media_type == 'link'){
                $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                }else {
                  $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                }
                $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
              $output .= '</td>';
              $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
              $output .= '</td>';
              $output .= '<td colspan="2"> '.$post->created_at.'</td>';
              $output .= '<td colspan="3"> '.$post->t_name.'</td>';
              $output .= '<td colspan="3"> '.$post->p_name.'</td>';
              $output .= '<td colspan="3"> 2812</td>';
              $output .= '<td colspan="3"> '.$post->likes.'</td>';
              $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
              $output .= '<td colspan="3"> -</td>';
              $output .= '<td colspan="3"> -</td>';
            $output .= '</tr>';
            }
            $output.='</tbody>';
            $output.='  </table>';
            $output.=$posts->render();
        }
        $x = array(
          'output' => $output,
          'total' => $total,
          'totalcount' => $totalcount,

        );
        echo json_encode($x);
         // return view('admin.ajaxnews',compact('posts'));
    }

    public function allcsv(Request $request)
    {
     $user_id=$request->session()->get('chat_admin')->id;
        $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
        ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
        ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
        ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
        ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
        ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
        ->where('wingg_app_user.id','=',$user_id)->get();
    $filename = "news.csv";
    $handle = fopen($filename, 'w+');
    fputcsv($handle, array('Title', 'Team', 'Roles','Targeted Audience', 'Likes', 'Dislike'));

    foreach($posts as $row) {
        fputcsv($handle, array($row->title, $row->t_name, $row->p_name,'200',$row->likes, $row->dislikes));
    }

    fclose($handle);

    $headers = array(
         'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
        'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
        'Content-Disposition' => 'attachment; filename=abc.csv',
        'Expires' => '0',
        'Pragma' => 'public',
    );

    return Response::download($filename, 'news.csv', $headers);
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function teamPost($id)
     {

          return view('admin.team');
     }
     public function teamPostajax(Request $request,$id)
      {
        $user_id=$request->session()->get('chat_admin')->id;
          $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
          ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
          ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
          ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
          ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
          ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
          ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();

          $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
          ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
          ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
          ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
          ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
          ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
          ->where('wingg_app_postteam.team_id','=',$id)->paginate(20);
          //dd($posts);
          $total = count($posts->items());
          $totalcount=$posts2->count();
          //dd($total);

          $output='';
          $output .= '<table class="table">';
          $output .= ' <thead>';
          $output .= '<th colspan="2"></th>';
          $output .= '<th colspan="2">Title</th>';
          $output .= '<th colspan="">Created at</th>';
          $output .= '<th colspan="3">Team</th>';
          $output .= '<th colspan="3">Roles</th>';
          $output .= '<th colspan="3">Targeted Audience</th>';
          $output .= '<th colspan="3">Likes</th>';
          $output .= '<th colspan="3">Dislike</th>';
          $output .= '<th colspan="3">blank_field</th>';
          $output .= '<th colspan="3">blank_field</th>';

          $output .= '</thead>';
          $output .= '<tbody >';

          if(!$posts->isEmpty())
          {
              foreach($posts as $post)
              {
                $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
                if($post->image_url){
                    $cover_image=$post->image_url;
                }else{
                  $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
                }
              $text_url = url('dashboard/edit-post-text/'.$post->id);
              $image_url = url('dashboard/edit-post-image/'.$post->id);
              $link_url = url('dashboard/edit-post-link/'.$post->id);
              $delete_url = url('dashboard/deletepost/'.$post->id);
              // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

              $output .= '<tr>';
                $output .= '<td class="action-btn" style="width: 9%;">';
                  if($post->media_type == 'text'){
                  $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                  }elseif($post->media_type == 'video/pdf'){
                  $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                  }elseif($post->media_type == 'link'){
                  $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                  }else {
                    $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                  }
                  $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                  $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
                $output .= '</td>';
                $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                  $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
                $output .= '</td>';
                $output .= '<td colspan="2"> '.$post->created_at.'</td>';
                $output .= '<td colspan="3"> '.$post->t_name.'</td>';
                $output .= '<td colspan="3"> '.$post->p_name.'</td>';
                $output .= '<td colspan="3"> 2812</td>';
                $output .= '<td colspan="3"> '.$post->likes.'</td>';
                $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
                $output .= '<td colspan="3"> -</td>';
                $output .= '<td colspan="3"> -</td>';
              $output .= '</tr>';
              }
              $output.='</tbody>';
              $output.='  </table>';
              $output.=$posts->render();
          }
          $x = array(
            'output' => $output,
            'total' => $total,
            'totalcount' => $totalcount,

          );
          echo json_encode($x);
      }

      public function postionPost($id)
      {

           return view('admin.role');
      }
     public function postionPostajax(Request $request,$id)
     {
       $user_id=$request->session()->get('chat_admin')->id;
         $posts2=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
         ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
         ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
         ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
         ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
         ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
         ->where('wingg_app_user.id','=',$user_id)->orderby('wingg_app_post.created_at','desc')->get();

         $posts=DB::table('wingg_app_post')->select('wingg_app_post.*','wingg_app_position.name AS p_name','wingg_app_team.name AS t_name')
         ->join('wingg_app_user','wingg_app_user.company_id','=','wingg_app_post.company_id')
         ->join('wingg_app_postteam','wingg_app_postteam.post_id','=','wingg_app_post.id')
         ->join('wingg_app_postposition','wingg_app_postposition.post_id','=','wingg_app_post.id')
         ->join('wingg_app_team','wingg_app_team.id','=','wingg_app_postteam.team_id')
         ->join('wingg_app_position','wingg_app_position.id','=','wingg_app_postposition.position_id')
         ->where('wingg_app_postposition.position_id','=',$id)->paginate(20);
         $total = count($posts->items());
         $totalcount=$posts2->count();
         //dd($total);

         $output='';
         $output .= '<table class="table">';
         $output .= ' <thead>';
         $output .= '<th colspan="2"></th>';
         $output .= '<th colspan="2">Title</th>';
         $output .= '<th colspan="">Created at</th>';
         $output .= '<th colspan="3">Team</th>';
         $output .= '<th colspan="3">Roles</th>';
         $output .= '<th colspan="3">Targeted Audience</th>';
         $output .= '<th colspan="3">Likes</th>';
         $output .= '<th colspan="3">Dislike</th>';
         $output .= '<th colspan="3">blank_field</th>';
         $output .= '<th colspan="3">blank_field</th>';

         $output .= '</thead>';
         $output .= '<tbody >';

         if(!$posts->isEmpty())
         {
             foreach($posts as $post)
             {
               $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
               if($post->image_url){
                   $cover_image=$post->image_url;
               }else{
                 $cover_image=url('frontend-assets/dashboard/img/faces/abc1.jpg');
               }
             $text_url = url('dashboard/edit-post-text/'.$post->id);
             $image_url = url('dashboard/edit-post-image/'.$post->id);
             $link_url = url('dashboard/edit-post-link/'.$post->id);
             $delete_url = url('dashboard/deletepost/'.$post->id);
             // $output .= '<div class="col-md-6 listing-grid img-append-grid" style="padding-left: 0;padding-right: 0;padding-bottom: 10px;margin-left: -4px;  width: 49.6%;">';

             $output .= '<tr>';
               $output .= '<td class="action-btn" style="width: 9%;">';
                 if($post->media_type == 'text'){
                 $output .= '<a href="'.$text_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                 }elseif($post->media_type == 'video/pdf'){
                 $output .= '<a href="'.$image_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                 }elseif($post->media_type == 'link'){
                 $output .= '<a href="'.$link_url.'" style="color:gray;"><i class="material-icons">edit</i></a>';
                 }else {
                   $output .= '<a href="" style="color:gray;"><i class="material-icons">edit</i></a>';
                 }
                 $output .= '<a href="'.$delete_url.'" class="demo" style="color:gray;"><i class="material-icons">delete</i></a>';
                 $output .= '<a href="" style="color:gray"><i class="material-icons">visibility</i></a>';
               $output .= '</td>';
               $output .= '<td colspan="2"> <img src="'.$cover_image.'" height="70px" width="60px" class="pull-left">';
                 $output .= '<span class="pl-10" style="display: flex;">'.$post->title.'</span>';
               $output .= '</td>';
               $output .= '<td colspan="2"> '.$post->created_at.'</td>';
               $output .= '<td colspan="3"> '.$post->t_name.'</td>';
               $output .= '<td colspan="3"> '.$post->p_name.'</td>';
               $output .= '<td colspan="3"> 2812</td>';
               $output .= '<td colspan="3"> '.$post->likes.'</td>';
               $output .= '<td colspan="3"> '.$post->dislikes.'</td>';
               $output .= '<td colspan="3"> -</td>';
               $output .= '<td colspan="3"> -</td>';
             $output .= '</tr>';
             }
             $output.='</tbody>';
             $output.='  </table>';
             $output.=$posts->render();
         }
         $x = array(
           'output' => $output,
           'total' => $total,
           'totalcount' => $totalcount,

         );
         echo json_encode($x);
     }


     public function show_gallery_index(Request $request)
     {
       $company_id=$request->session()->get('chat_admin')->company_id;
       $sections=DB::table('wingg_app_section')->where('company_id',$company_id)->orderBy('id','asc')->get();
       // dd($sections);
       return view('admin.gallery.gallery-index',compact('sections'));

     }
     public function show_gallery(Request $request)
     {
       $get_type = $request->input('type');
       $main_type='';
       $main_id='';
       if ($get_type !="") {
       $data = explode(',',$get_type);
       $main_type = $data[0];
       $main_id = $data[1];
      }

       // dd($type.'/'.$id);
       $company_id=$request->session()->get('chat_admin')->company_id;
       $sections=DB::table('wingg_app_section')->where('company_id',$company_id);
       if ($main_type !='') {
        $sections->where('type',$main_type);
       }
       if ($main_id !='') {
        $sections->where('team_role_id',$main_id);
       }
      $sections=$sections->orderBy('id','asc')->get();
       // dd($sections);
       return view('admin.gallery.index',compact('sections','main_type','main_id'));

     }
     public function gallerySectionstore(Request $request)
     {
       // dd($request->all());
       $company_id=$request->session()->get('chat_admin')->company_id;
           $input['title']=$request->input('title');
           $input['company_id']=$company_id;
           $get_type = $request->input('type');
           $data = explode(',',$get_type);
           $type = $data[0];
           $id = $data[1];
           $input['type']=$type;
           $input['team_role_id']=$id;
           $input['created_at']=  date('Y-m-d H:i:s');
           $input['updated_at']=  date('Y-m-d H:i:s');
           // dd($input);
           $section=DB::table('wingg_app_section')->insertGetId( $input);
           echo $section;

     }
     public function galleryimagestore(Request $request)
         {
            // dd($request->all());
             if($request->isMethod('post')){
              //  dd($request->all());
             $company_id=$request->session()->get('chat_admin')->company_id;
                 $input['title']=$request->input('post_title');
                 $input['company_id']=$company_id;
                 $input['section_id']=$request->input('section_id');
                 $input['created_at']=  date('Y-m-d H:i:s');
                 $input['updated_at']=  date('Y-m-d H:i:s');
                  $image = $request->file('cover_image');
                  $file = $request->file('file');
                  // dd($file->getClientMimeType());
                 if ($image !="") {
                 $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
                 $destinationPath = public_path('gallery/cover');
                 $image->move($destinationPath, $profilePicture);
                 $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/gallery/cover/'.$profilePicture;
                 $input['cover_image']=$imagepath;
                 }

                 if ($file !="") {
                 $profilePictures = 'file-'.time().'-'.rand(000000,999999).'.'.$file->getClientOriginalExtension();
                 $destinationPaths = public_path('gallery/images');
                 $file->move($destinationPaths, $profilePictures);
                 $imagepaths='http://phplaravel-375170-1174358.cloudwaysapps.com/gallery/images/'.$profilePictures;
                 $input['image']=$imagepaths;
                 }
                 // dd($input);
                $post_id=DB::table('wingg_app_gallery')->insertGetId($input);
                $data['order']=$post_id;
                $post=DB::table('wingg_app_gallery')->where('id',$post_id)->update($data);

     		   if($post_id !=0){
     			   $request->session()->flash('post', 'Content Created Sussessfully');
                 //return redirect('/dashboard');
            echo $post_id;
           }
             }
            // return view('admin.add-post');
         }

         public function reorder_images(Request $request)
         {
           // dd($request->all());
           $imageIdsArray = $request->input('imageIds');

           $count = 1;
           foreach ($imageIdsArray as $id) {

             // $sql = $conn->prepare("UPDATE tbl_images SET image_order=? WHERE id=?");
             $imageOrder = $count;
             $imageId = $id;
             $input['order']=$imageOrder;
             // dd($imageOrder.'/'.$imageId);
             // dd($input,$imageId);
             $data = DB::table('wingg_app_gallery')->where('id',$imageId)->update($input);
             // dd($data);
             $response = 'Images order is updated';
             // if ($data !=0) {
             // }else {
             //   $response = 'Problem in Changing the Image Order';
             // }
             $count ++;
           }

           echo $response;
         }

         public function edit_content(Request $request)
         {
           // dd($request->all());
           $id = $request->input('content_id');
           $input['title']=$request->input('title');
           $image = $request->file('cover_image');
           if ($image !="") {
             $profilePicture = 'cover_image-'.time().'-'.rand(000000,999999).'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('gallery/cover');
             $image->move($destinationPath, $profilePicture);
             $imagepath='http://phplaravel-375170-1174358.cloudwaysapps.com/gallery/cover/'.$profilePicture;
             $input['cover_image']=$imagepath;
           }
           // dd($input);
           $post_id=DB::table('wingg_app_gallery')->where('id',$id)->update($input);
           $request->session()->flash('post', 'Content Updated Sussessfully');
           return redirect('/dashboard/gallery');
         }

         public function delete_content(Request $request, $id)
         {
           // dd($id);
           $content = DB::table('wingg_app_gallery')->where('id',$id)->delete();
           $request->session()->flash('post', 'Content Deleted Sussessfully');
           return redirect('/dashboard/gallery');
         }

         public function duplicate_section(Request $request)
         {
           // dd($request->all());
               $section_id=$request->input('section_id');
               $sec_info = DB::table('wingg_app_section')->where('id',$section_id)->first();
               $content_info = DB::table('wingg_app_gallery')->where('section_id',$section_id)->get();
               // dd($content_info);
               $input['title']=$request->input('section_title');
               $input['company_id']=$sec_info->company_id;
               $get_type = $request->input('type');
               if ($get_type !="") {
                 // dd($get_type);
               $data = explode(',',$get_type);
               $type = $data[0];
               $id = $data[1];
               $input['type']=$type;
               $input['team_role_id']=$id;
             }else {
               $input['type']=$sec_info->type;
               $input['team_role_id']=$sec_info->team_role_id;
             }
             $input['created_at']=  date('Y-m-d H:i:s');
             $input['updated_at']=  date('Y-m-d H:i:s');
             // dd($input);
             $sec_id = DB::table('wingg_app_section')->insertGetId($input);

             foreach ($content_info as $key => $value) {
               $data2['section_id'] = $sec_id;
               $data2['company_id'] = $value->company_id;
               $data2['title'] = $value->title;
               $data2['image'] = $value->image;
               $data2['cover_image'] = $value->cover_image;
               $data2['created_at']=  date('Y-m-d H:i:s');
               $data2['updated_at']=  date('Y-m-d H:i:s');
               $cont_id = DB::table('wingg_app_gallery')->insertGetId($data2);
               $data3['order']=$cont_id;
               $cont2 =DB::table('wingg_app_gallery')->where('id',$cont_id)->update($data3);
               // dd($data2);
             }
           $request->session()->flash('post', 'Section Duplicated Sussessfully');
           return redirect('/dashboard/gallery');
         }

         public function edit_section(Request $request)
         {
           // dd($request->all());
           $id = $request->input('section_id');
           $input['title']=$request->input('section_title');
           $get_type = $request->input('type');
           if ($get_type !="") {
             // dd($get_type);
           $data = explode(',',$get_type);
           $type = $data[0];
           $type_id = $data[1];
           $input['type']=$type;
           $input['team_role_id']=$type_id;
         }
           // dd($input);
           $post_id=DB::table('wingg_app_section')->where('id',$id)->update($input);
           $request->session()->flash('post', 'Section Updated Sussessfully');
           return redirect('/dashboard/gallery');
         }

         public function delete_section(Request $request, $id)
         {
           // dd($id);
           $section = DB::table('wingg_app_section')->where('id',$id)->delete();
           $section = DB::table('wingg_app_gallery')->where('section_id',$id)->delete();
           $request->session()->flash('post', 'Section Deleted Sussessfully');
           return redirect('/dashboard/gallery');
         }

         public function search_gallery(Request $request)
         {
           // dd($request->all());
           $keyword = $request->searchkeyword;
           $get_type = $request->type;
           $type='';
           $type_id='';
           if ($get_type !="") {
             $data = explode(',',$get_type);
             $type = $data[0];
             $type_id = $data[1];
           }
           // dd($type.'/'.$type_id);
           $company_id=$request->session()->get('chat_admin')->company_id;
           $sections = DB::table('wingg_app_section')->where('wingg_app_section.company_id','=',$company_id);
           if ($type !=null) {
             $sections->where('wingg_app_section.type','=',$type);
           }
           if ($type_id !=null) {
             $sections->where('wingg_app_section.team_role_id','=',$type_id);
           }
           $sections =$sections->get();
           foreach ($sections as &$sec) {
             $sec->gallery=DB::table('wingg_app_gallery')->where('section_id',$sec->id)->where('wingg_app_gallery.title', 'ilike', '%' . $keyword . '%')->get()->toArray();
           }
           return view('admin.gallery.ajaxgallery',compact('sections'));
         }
            // function returndup($arr)
            // {
            //   return array_diff_key($arr, array_unique($arr));
            // }
}
