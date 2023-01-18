<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Usps;
use Session;
use App\Models\User;
use Hash;
  
class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
      $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin');
        }
        $error = 'You have entered invalid credentials';
        return redirect("login")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    public function address(Request $request)
    {   
      $input_xml = <<<EOXML
        <AddressValidateRequest USERID="262DIGNI1213">
            <Address ID="0">
                <Address1>2335 S State</Address1>
                <Address2>$request->address</Address2>
                <City>$request->city</City>
                <State>$request->state</State>
                <Zip5></Zip5>
                <Zip4></Zip4>
            </Address>
        </AddressValidateRequest>
        EOXML;

        $fields = array(
            'API' => 'Verify',
            'XML' => $input_xml
        );

        $url = 'http://production.shippingapis.com/ShippingAPITest.dll?' . http_build_query($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);

        $array_data = json_decode(json_encode(simplexml_load_string($data)), true);
        $error = @$array_data['Address']['Error']['Description'];

      if($request->standardized == '' )
      {
        if(!$error){
          $address = $array_data['Address']['Address2'];
          $city = $array_data['Address']['City'];
          $state = $array_data['Address']['State'];
          $zip1 = $array_data['Address']['Zip5'];
          $zip2 = $array_data['Address']['Zip4'];
          $new_address = [$address, $city, $state, $zip1, $zip2];
          $address_data = implode(", ", $new_address);
          $address_fix = [$request->address,$request->city,$request->state];
          $usps_address = implode(", ", $address_fix);

            return response()->json([
              'status' => 200,
              'address' => $usps_address,
              'usps'=> $address_data
          ]);
        }
        else {
          return response()->json([
            'status' => 202,
            'error' => $array_data['Address']['Error']['Description'],
        ]);
        }
      }
      else{
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->address = $request->standardized;
        $user->save();

          return response()->json([
            'status' => 200,
            'message' =>'Address add Successfully'
        ]);
      }
      

    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}