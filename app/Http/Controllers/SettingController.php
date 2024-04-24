<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\FileUploadTrait;

class SettingController extends Controller
{
    use FileUploadTrait;
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $settings = DB::table('settings')->pluck('option_value', 'option_key');
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
      
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    public function update(Request $request)
    {
        if ($request->hasFile('logo')) {
            $uploadedFile = $request->file('logo');
            // $folder = public_path('images');
            $folder = 'logo';
            $previousImage = Setting::where('option_key', 'logo')->first();
            $newImagePath = $this->uploadFile($uploadedFile, $folder);
            if ($previousImage) {
                //$this->deleteFile(public_path('images/' . $previousImage->option_value));
                $this->deleteFile('logo/' . $previousImage->option_value);
            }
            Setting::where('option_key', 'logo')->update(['option_value' => $newImagePath]);
        }
        /*
        if ($request->hasFile('logo')) {
            $allowedfileExtension = ['jpeg', 'jpg', 'png'];
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension);
            if ($check) {
                $img = rand(1000000000, 9999999999) . $file->getClientOriginalName();
                $previousImage = Setting::where('option_key', 'logo')->first();
                $img = rand(1000000000, 9999999999) . $file->getClientOriginalName();
                $file->move('images/', $img);
                $imagePath = public_path('images/'.$previousImage->option_value);
                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
                
                // $request->file('image')->store('images', 'public');
                // if ($previousImage) {
                //   Storage::disk('public')->delete('images/' . $previousImage->option_value);
                // }
                
                Setting::where('option_key', 'logo')->update(['option_value' => $img]);
            }
        }
        */
        Setting::where('option_key', 'title')->update(['option_value' => $request->title]);
        Setting::where('option_key', 'ratio1')->update(['option_value' => $request->ratio1]);
        Setting::where('option_key', 'ratio2')->update(['option_value' => $request->ratio2]);
        Setting::where('option_key', 'ratio3')->update(['option_value' => $request->ratio3]);
        Setting::where('option_key', 'currency')->update(['option_value' => $request->currency]);
        
        return redirect()->route('settings.index')->with('edit_success', 'true');
    }

    public function destroy(string $id)
    {
        
    }
}
