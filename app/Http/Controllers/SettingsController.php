<?php namespace App\Http\Controllers;
use Request;
use Storage;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Controller;
use App\Http\Controllers\FileContoller;
use League\Flysystem\AwsS3v2\AwsS3Adapter;
use DateTime;
# Model
use App\BackendModel\User as User;
use App\Property;
use App\VehicleMake;
use Auth;
use File;
use Hash;
use DB;


class SettingsController extends Controller {

	public function __construct () {
		$this->middleware('auth');
		view()->share('active_menu', 'settings');
	}
	public function index()
	{
		$user_forsave = $user = User::find(Auth::user()->id);
		if(Request::isMethod('post')) {
			$input = Request::except('email','password');
            $user_forsave->name = trim(Request::get('fname'))." ".trim(Request::get('lname'));
			$user_forsave->phone = Request::get('phone');

			if(Request::get('gender')){
				$user_forsave->gender = Request::get('gender');
			}
            if(Request::get('dob') != null){
                $user_forsave->dob = Request::get('dob');
            }

			if(!empty(Request::get('pic_name'))) {
				if(!empty($user->profile_pic_name)) {
					$this->removeFile($user->profile_pic_name);
				}
				$name 	= Request::get('pic_name');
				$x 		= Request::get('img-x');
				$y 		= Request::get('img-y');
				$w 		= Request::get('img-w');
				$h 		= Request::get('img-h');

				cropProfileImg ($name,$x,$y,$w,$h);
				$path 	= $this->createLoadBalanceDir(Request::get('pic_name'));
				$user_forsave->profile_pic_name = Request::get('pic_name');
				$user_forsave->profile_pic_path = $path;
			}
			if($user_forsave->save()) {
				Auth::loginUsingId($user_forsave->id);
				return redirect('settings');
			}
		} else {
			$name =  explode(" ",$user->name);
			$user->fname = $name[0];
			$user->lname = empty($name[1])?"":$name[1];
	        if($user->dob) {
	            $temp_dob = $user->dob;
	            $date = DateTime::createFromFormat("Y-m-d", $temp_dob);
	            $user->dob = $date->format("D, d M Y");
	        }
			return view('settings.index')->with(compact('user'));
		}

		return view('settings.index')->with(compact('user'));
	}

	public function password () {
		$property = Property::find(Auth::user()->property_id);
		$is_demo = false;
		if(isset($property)){
			if($property->is_demo) {
				$is_demo = true;
			}
		}

		if(Request::isMethod('post')) {
			if ( !Hash::check(Request::get('old_password'), Auth::user()->password) ) {
		        return redirect()->back()->withErrors(['password'=> trans('messages.Settings.old_not_match') ]);
		    } else {
				if(!$is_demo) {
					$user = User::find(Auth::user()->id);
					$user->password = Hash::make(Request::get('new_password'));
					$user->save();
					Auth::loginUsingId($user->id);
					Request::session()->put('success.message', trans('messages.Settings.change_pass_success'));
				}else{
					Request::session()->put('success.message', "Function Disable");
				}
		    }
		}

		return view('settings.password')->with(compact('is_demo'));
	}

	public function language (Application $app) {
		$user = User::find(Auth::user()->id);
		if(Request::isMethod('post')) {
			$user->lang = Request::get('language');
			$user->save();
			Auth::loginUsingId($user->id);
			$app->setLocale(Auth::user()->lang);
		}
		return view('settings.language')->with(compact('user'));
	}

	public function createLoadBalanceDir ($name) {
		$targetFolder = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR;
		$folder = substr($name, 0,2);
		$pic_folder = 'profile-img/'.$folder;
        $directories = Storage::disk('s3')->directories('profile-img'); // Directory in Amazon
        if(!in_array($pic_folder, $directories))
        {
            Storage::disk('s3')->makeDirectory($pic_folder);
        }
        $full_path_upload = $pic_folder."/".$name;
        $upload = Storage::disk('s3')->put($full_path_upload, file_get_contents($targetFolder.$name), 'public');
        File::delete($targetFolder.$name);
		return $folder."/";
	}

	public function removeFile ($name) {
		$folder = substr($name, 0,2);
		$file_path = 'profile-img/'.$folder."/".$name;
		if(Storage::disk('s3')->has($file_path)) {
			Storage::disk('s3')->delete($file_path);
		}

	}
}
