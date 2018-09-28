<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Classes;
use App\Student;
use App\User;
use App\Activity;
use App\TestPaper;
use App\Reports\ExamsClass;
use App\Reports\Progress;
use App\Reports\Top10;
use App\Reports\Report;
use Carbon\Carbon;

class PagesController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $pages = array(
        "home" => array("Welcome", "home", "False"),
        "classes"=> array("Classes", "users", "False"),
        "activities" => array("Activities", "layers", "False"),
        "report" => array("Reports", "bar-chart-2", "False"),
        "records" => array("Records", "archive", "True"),
        "settings" => array("Settings", "sliders", "False"),
        "logout" => array("Log Out", "log-out", "False")
    );

    public function getClasses() {
        if (Auth::user()) {
            $user = Auth::user()->id;
            return Classes::where('user_id', '=', $user)->get(); 
        } else {
            return Classes::all();
        }
    }

    public function storeClasses(Request $request) {
        $this->validate($request, [
            'classname' => 'required'
        ]);
        $classes = new Classes();
        $classes->classname = $request->input('classname');
        $classes->user_id = Auth::user()->id;
        $classes->save();
        return redirect('/classes')->with('success', 'Class Added');
    }

    public function deleteClasses(Request $request) {
        Classes::destroy($request->input('id'));
        return redirect('/classes')->with('success', 'Class Deleted');
    }

    public function storeStudents(Request $request) {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'contactnumber' => 'required',
            'email' => 'required|string|max:255|unique:students',
            'age' => 'required|numeric'
        ]);
        
        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/student_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.png';
        }

        $students = new Student();
        $students->firstname = $request->input('firstname');
        $students->lastname = $request->input('lastname');
        $students->gender = $request->input('gender');
        $students->contactnumber = $request->input('contactnumber');
        $students->email = $request->input('email');
        $students->age = $request->input('age');
        $students->photo = $fileNameToStore;
        $students->classes_id = $request->input('classes_id');
        $students->save();
        return redirect("classes/".$request->input('classes_id'))->with('success', 'Student Added');
    }

    public function deleteStudent(Request $request) {
        Student::destroy($request->input('id'));
        return redirect('classes/'.$request->input('classes_id'))->with('success', 'Student Deleted');
    }

    protected function getUserUsingEmail($email) {
        $student = Student::where('email', '=', $email)->get()[0];
        $classinfo = Classes::where('id', '=', $student->classes_id)->get();
        $student->teacherinfo = User::where('id', '=', $classinfo[0]->user_id)->get()[0];
        $act = Activity::where('classes_id', '=', $student->classes_id);
        $student->activities = array(
            "letters"=>$act->where('category', '=', "letters")->get(),
            "shapes"=>$act->where('category', '=', "shapes")->get(),
            "numbers"=>$act->where('category', '=', "numbers")->get(),
            "colors"=>$act->where('category', '=', "colors")->get(),
        );
        $student->classinfo = $classinfo[0];
        return $student;
    }

    protected function storeUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/user_images', $fileNameToStore);
        } else {
            $fileNameToStore = 'default.png';
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->isAdmin = "False";
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->photo = $fileNameToStore;
        $user->contactnumber = $request->input('contactnumber');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return redirect('/records')->with('success', 'Teacher Added');
    }

    protected function submitStudent($a, $b, $c, $d, $e, $f, $g)
    {
        $existing = Student::where('email', '=', $e)->get();
        if(count($existing) == 0) {
            $students = new Student();
            $students->firstname = $a;
            $students->lastname = $b;
            $students->gender = $c;
            $students->contactnumber = $d;
            $students->email = $e;
            $students->age = $f;
            $students->photo = "default.png";
            $students->classes_id = $g;
            $students->save();
            return $students;
        } else {
            return 'Username already taken';
        }
    }

    protected function editStudent($id) {
        $data = array(
            'title' => 'Edit Teacher',
            'pages' => $this->pages,
            'student' => Student::find($id)
        );
        return view('pages.editstudent')->with($data);
    }

    public function updateStudent(Request $request) {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'contactnumber' => 'required',
            'email' => 'required|string|max:255',
            'age' => 'required|numeric'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/student_images', $fileNameToStore);
        } else {
            $fileNameToStore = $request->input('current_photo');
        }

        $students = Student::find($request->input('my_id'));
        $students->firstname = $request->input('firstname');
        $students->lastname = $request->input('lastname');
        $students->gender = $request->input('gender');
        $students->contactnumber = $request->input('contactnumber');
        $students->email = $request->input('email');
        $students->age = $request->input('age');
        $students->photo = $fileNameToStore;
        $students->classes_id = $request->input('classes_id');
        $students->save();
        return redirect("student/".$students->id)->with('success', 'Student Updated');
    }

    public function deleteUser($id) {
        if (Auth::user()->isAdmin != "True") {
            return redirect('/home')->with('error', 'No Permission');
        }
        User::destroy($id);
        return redirect('/records')->with('success', 'Teacher Deleted');
    }

    public function editActivity($id) {
        $data = array(
            'title' => 'Edit Activity',
            'pages' => $this->pages,
            'activity' => Activity::find($id)
        );
        return view('pages.editactivity')->with($data);
    }

    public function storeActivity(Request $request) {
        $this->validate($request, [
            'question' => 'required|max:255',
            'answer' => 'required',
            'choice1' => 'image|nullable|max:1999',
            'choice2' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('choice1')) {
            $filenameWithExt = $request->file('choice1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('choice1')->getClientOriginalExtension();
            $fileNameToStore1 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('choice1')->storeAs('public/activity_images', $fileNameToStore1);
        } else {
            $fileNameToStore1 = 'default.jpg';
        }


        if ($request->hasFile('choice2')) {
            $filenameWithExt = $request->file('choice2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('choice2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('choice2')->storeAs('public/activity_images', $fileNameToStore2);
        } else {
            $fileNameToStore2 = 'default.jpg';
        }

        $activity = new Activity();
        $activity->category = $request->input('category');
        $activity->question = $request->input('question');
        $activity->answer = $request->input('answer');
        $activity->choice1 = $fileNameToStore1;
        $activity->choice2 = $fileNameToStore2;
        $activity->classes_id = $request->input('classes_id');
        $activity->save();
        return redirect("activities/".$request->input('category')."/".$request->input('classes_id'))->with('success', 'Activity Added');

    }
    
    public function updateActivity(Request $request) {

        $this->validate($request, [
            'question' => 'required|max:255',
            'answer' => 'required',
            'choice1' => 'image|nullable|max:1999',
            'choice2' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('choice1')) {
            $filenameWithExt = $request->file('choice1')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('choice1')->getClientOriginalExtension();
            $fileNameToStore1 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('choice1')->storeAs('public/activity_images', $fileNameToStore1);
        } else {
            $fileNameToStore1 = $request->input('current_choice1');
        }


        if ($request->hasFile('choice2')) {
            $filenameWithExt = $request->file('choice2')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('choice2')->getClientOriginalExtension();
            $fileNameToStore2 = $filename.'_'.time().'.'.$extension;
            $path = $request->file('choice2')->storeAs('public/activity_images', $fileNameToStore2);
        } else {
            $fileNameToStore2 = $request->input('current_choice2');
        }

        $activity = Activity::find($request->input('cid'));
        $activity->category = $request->input('category');
        $activity->question = $request->input('question');
        $activity->answer = $request->input('answer');
        $activity->choice1 = $fileNameToStore1;
        $activity->choice2 = $fileNameToStore2;
        $activity->classes_id = $request->input('classes_id');
        $activity->save();
        return redirect("activities/".$request->input('category')."/".$request->input('classes_id'))->with('success', 'Activity Updated');

    }

    public function deleteActivity($id) {
        $cid = Activity::find($id)->classes_id;
        $cat = Activity::find($id)->category;
        Activity::destroy($id);
        return redirect('activities/'.$cat.'/'.$cid)->with('success', 'Activity Deleted');
    }

    public function index() {
        $data = array(
            'title' => 'WELCOME!!',
            'pages' => $this->pages
        );
        return view('pages.home')->with($data);
    }

    public function students($id) {
        if (Classes::find($id) && Classes::find($id)->user_id != Auth::user()->id) {
            return redirect('/classes')->with('error', 'Class Not Allowed');
        }
        $classes = $this->getClasses();
        if (empty($classes)) $classes = [];
        $students = Student::where('classes_id', '=', $id)->get();
        if (empty($students)) $students = [];
        $data = array(
            'title' => 'List of Students: '.Classes::find($id)->classname,
            'pages' => $this->pages,
            'students' => $students,
            'classes' => $classes,
            'active_class' => $id
        );
        return view('pages.classes')->with($data);
    }

    public function records() {
        $users = User::all();
        if (empty($users)) $users = [];
        $data = array(
            'title' => 'List of Teachers',
            'pages' => $this->pages,
            'users' => $users
        );
        return view('pages.records')->with($data);
    }

    public function settings() {
        $data = array(
            'title' => 'Profile',
            'pages' => $this->pages,
            'user' => Auth::user()
        );
        return view('pages.settings')->with($data);
    }

    public function updateUser(Request $request) {
        if (Auth::user()->isAdmin != "True") {
            return redirect('/home')->with('error', 'No Permission');
        }
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255'
        ]);

        if ($request->hasFile('photo')) {
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('photo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $path = $request->file('photo')->storeAs('public/user_images', $fileNameToStore);
        } else {
            $fileNameToStore = $request->input('current_photo');
        }

        $user = User::find($request->input('my_id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->photo = $fileNameToStore;
        $user->contactnumber = $request->input('contactnumber');
        if (Auth::user()->isAdmin == "True"){
            $isAdmin = $request->input('isAdmin');
            if(empty($isAdmin)) $isAdmin = "False";
            $user->isAdmin = $isAdmin;
        }
        $user->save();

        if (empty($request->input('my_self'))) {
            return redirect('records/'.$user->id)->with('success', 'User Updated');
        }
        return redirect('/settings')->with('success', 'Profile Updated');
    }
    
    public function editUser($id) {
        if (Auth::user()->isAdmin != "True") {
            return redirect('/home')->with('error', 'No Permission');
        }
        $data = array(
            'title' => 'Edit Teacher',
            'pages' => $this->pages,
            'user' => User::find($id)
        );
        return view('pages.editrecords')->with($data);
    }

    public function classes() {
        $classes = $this->getClasses();
        if (empty($classes)) $classes = [];
        $data = array(
            'title' => 'My Classes',
            'pages' => $this->pages,
            'students' => [],
            'classes' => $classes
        );
        return view('pages.classes')->with($data);
    }

    public function activities() {
        $classes = $this->getClasses();
        if (empty($classes)) return redirect('classes/').with('error', 'No Classes. Please add first...');
        $cid = $classes[0]->id;
        return redirect('activities/letters/'.$cid);
    }

    public function questions($category, $id) {
        if (Classes::find($id) && (Classes::find($id)->user_id != Auth::user()->id)) { 
            return redirect('/activities')->with('error', 'Class Not Allowed');
        }
        $classes = $this->getClasses();
        if (empty($classes)) $classes = [];
        $activity = Activity::where([['classes_id', '=', $id], ['category', '=', $category]])->get();
        if (empty($activity)) $activity = [];
        $categories = array(['letters', 'Letters'], ['numbers','Numbers'], ['colors', 'Colors'], ['shapes', 'Shapes']);
        $data = array(
            'title' => 'List of Questions: '.Classes::find($id)->classname,
            'pages' => $this->pages,
            'activities' => $activity,
            'ac_classes' => $classes,
            'active_class' => $id,
            'categories' => $categories,
            'active_category' => $category
        );
        return view('pages.activities')->with($data);
    }


    public function checkReports() {
        $classes = $this->getClasses();
        if (empty($classes)) return redirect('classes/').with('error', 'No Classes. Please add first...');
        $cid = $classes[0]->id;
        return redirect('reports/'.$cid);
    }

    public function submitPaper($sid, $score, $ans) {
        $student = Student::find($sid);
        if (empty($student)) return "No existing user";

        $existing = TestPaper::where('student_id', '=', $sid)->whereDate('created_at', Carbon::today())->get();
        if (count($existing) == 0) {
            $test = new TestPaper();
            $test->student_id = $sid;
            $test->score = $score;
            $test->answer_sheet = $ans;
            $test->save();
            return $test;
        } else {
            return "Already take an exam for today";
        }
    }

    public function reports($id)
    {
        $classes = $this->getClasses();
        if (Auth::user()->isAdmin == "False" && Classes::find($id) && (Classes::find($id)->user_id != Auth::user()->id)) { 
            return redirect('/home')->with('error', 'Class Not Allowed');
        } else {
            $classes = Classes::all();
        }
        if (empty($classes)) $classes = [];
        $examsclass = new ExamsClass(array(
                "class"=>$id
        ));
        $examsclass->run();
        $top10 = new Top10(array(
                "class"=>$id
        ));
        $top10->run();
        $data = array(
            'title' => 'My Reports',
            'pages' => $this->pages,
            'examsclass' => $examsclass,
            'ac_classes' => $classes,
            'active_class' => $id,
            'top10' => $top10
        );
        return view('pages.reports')->with($data);
    }

    public function report($id)
    {
        $report = new Report(array(
            "class"=>$id
        ));
        $report->run();
        $student = Student::find($id);
        $classes = Classes::find($student->classes_id);
        $teacher = User::find($classes->user_id);
        $progress = new Progress(array(
                "class"=>$id
        ));
        $progress->run();
        $data = array(
            'title' => 'Report Card',
            'pages' => $this->pages,
            'report' => $report,
            'info'=> $student,
            'teacher'=>$teacher,
            'xclasses'=>$classes,
            'progress'=>$progress
        );
        return view('pages.report')->with($data);
    }

}
