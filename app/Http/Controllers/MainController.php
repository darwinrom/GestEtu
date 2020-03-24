<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifiedUser;
use App\Http\Requests\ValidationFormulaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SgnUpMail;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade as PDF;



class MainController extends Controller

{

    public function index(){
        return view('accueil');
    }

    public function inscription(){
        if (session::has("id")){
            return redirect(route('dashboard'));
        }else{
            $data = DB::table('Fillieres')->get();
            return view('inscription',compact('data'));
        }
    }

    public function connexion(){
        if (session::has("id")){
            $listComposer=$this->liste_note();

            return view('dashboard',compact('listComposer'));
        }else{
            return view('connexion');
        }

    }

    public function deconnecter(){
        session::flush();
      return redirect(route('Home'));
    }


    public function traitement(ValidationFormulaire $req){
       if($req->hasFile('photo')){
           $fileName=$req->file('photo');
           $_Name=time().'.'.$fileName->getClientOriginalExtension();
           $dest=public_path('images');
           $fileName->move($dest,$_Name);
       }else{
           $fileName=null;
       }

            $PseudoExist = DB::table('Etudiants')
               ->where( 'pseudo', $req->pseudo)->exists();
            $EmailExist = DB::table('Etudiants')
            ->where('email', $req->email)->exists();

              if ($EmailExist && $PseudoExist) {
                  return redirect()->back()->withErrors(["Cet email et Ce pseudo sont dejà pris"])->withInput();
              }elseif ($EmailExist) {
                return redirect()->back()->withErrors(["Cet email est dejà pris"])->withInput();
              }elseif ($PseudoExist) {
                return redirect()->back()->withErrors(["Cet email est dejà pris"])->withInput();
              }
               else {
                $etu = DB::table('Etudiants')->insert([
                    "pseudo"=> $req->pseudo,
                    "email"=> $req->email,
                    "password"=> $req->passwd,
                    "nom"=> $req->nom,
                    "prenom"=> $req->prenom,
                    "code_fil"=> $req->filiere,
                    "photo"=> $_Name,

                ]);
               if ($etu) {
                    Mail::to($req->email)->send(new SgnUpMail($req->nom,$req->prenom));
                    return view('accueil');
               }
              }

    }

    public function traitementC(Request $request){

      // $validate = $request->validated();
          $validate = Validator::make($request->all(), [
           'pseudo'  => "required",
           'passwd'   => "required"
        ]);
        if ($validate->fails()) {

          Session::flash('error', $validate->messages()->first());
         return redirect()->back()->withErrors($validate)->withInput();
        } else {

            $user = DB::table('Etudiants')->where([
                ['pseudo', $request->pseudo],
                ['password', $request->passwd]
                ])->exists();

             if ($user) {
                 $user = DB::table('Etudiants')->where([
                     ['pseudo', $request->pseudo],
                     ['password', $request->passwd]
                 ])->get('num_mat');
                 session::put("id",$user);
                return redirect()->route('dashboard');
             }else {

               return view('connexion');
             }
        }



    }

    public function dashboard(Request $request){
       if (session::has("id")){
           if($request->enreg){
               DB::table('composer')
                   ->where([['code_mat',decrypt($request->enreg)]])
                   ->delete();
           }
           $listComposer=$this->liste_note();

           return view('dashboard',compact('listComposer'));
       }else{
            return redirect(route('SignUp'));
       }

    }

    public function ajoutNote(){
        if (session::has("id")){
            $data= DB::table('matieres')->get();
            return view('ajoutNote',compact('data'));
        }else{
            return redirect(route('SignUp'));
        }

    }

    public function ajoutTraitement(Request $request){
        $id=session('id');
        $validate = Validator::make($request->all(), [
            'note'  => "required",
            'matiere'   => "required"
        ]);
        if ($validate->fails()) {

            Session::flash('error', $validate->messages()->first());
            return redirect()->back()->withErrors($validate)->withInput();
        } else {
        $Exist= DB::table('composer')->where([
            ['code_mat', $request->matiere],
            ['num_mat', $id->get(0)->num_mat]
        ])->exists();
        if($Exist){
            return redirect()->back()->withErrors(["Note deja inscrite pour cette matiere"])->withInput();
        }else{

            DB::table('composer')->insert([
                'code_mat'=>$request->matiere,
                'num_mat'=> $id->get(0)->num_mat,
                'note'=> $request->note
            ]);
           return redirect(route('dashboard'));
        }
    }

    }

    public function liste_note(){
        $id=session('id');

    return DB::table('composer')
            ->join('matieres','composer.code_mat','=','matieres.code_mat')
            ->where([['composer.num_mat',$id->get(0)->num_mat]])
            ->get();


    }
    public function note_updated(Request $request){
        if (session::has("id")){
            if($request->enreg){
                $id=session('id');
                $data= DB::table('composer')
                    ->where([
                        ['num_mat',$id->get(0)->num_mat],
                        ['code_mat',decrypt($request->enreg)]
                    ])
                    ->get();

                    return view('noteupdated',compact('data'));
            }else{
                return redirect(route('dashboard'));
            }
        }else{
            return redirect(route('SignUp'));
        }
}

        public function  traitNM(Request $request){
            if (session::has("id")){
                $validate = Validator::make($request->all(), [
                    'note'  => "required",

                ]);
                if ($validate->fails()) {

                    Session::flash('error', $validate->messages()->first());
                    return redirect()->back()->withErrors($validate)->withInput();
                } else {
               DB::table('composer') ->where([
                   ['num_mat',session('id')->get(0)->num_mat],
                   ['code_mat',$request->code_mat]
               ])->update(['note'=>$request->note]);


               return redirect(route('dashboard'));

            }
            }else{
                return redirect(route('SignUp'));
            }

        }

        public function profil(){
            if (session::has("id")){
                $data=$this->InfoP();
                return view('profil',compact('data'));
            }else{
                return redirect(route('SignUp'));
            }

        }

    public function profilP(){
        if (session::has("id")){
            $data=$this->InfoP();
            return view('modifierProfil',compact('data'));
        }else{
            return redirect(route('SignUp'));
        }

    }

    public function InfoP(){
      $Etu= DB::table('Etudiants')
           ->where([
               ['num_mat',session('id')->get(0)->num_mat]
               ])->get();
      session::put('AncienPhoto',$Etu->get(0)->photo);
      return $Etu;
    }

    public function traitement_profil_update(ValidationFormulaire $req){
        if (session::has("id")){

            if ($req->file('photo')==null){
                $_Name=session('AncienPhoto');
            }else{
                $fileName=$req->file('photo');
                $_Name=time().'.jpg';
                $dest=public_path('images');
                $fileName->move($dest,$_Name);
            }

            DB::table('Etudiants') ->where([
                ['num_mat',session('id')->get(0)->num_mat],
            ])->update([
                "pseudo"=> $req->pseudo,
                "email"=> $req->email,
                "password"=> $req->passwd,
                "nom"=> $req->nom,
                "prenom"=> $req->prenom,
                "photo"=> $_Name,
                ]);
            return redirect(route('profil'));
        }else {

            return redirect(route('SignUp'));
        }
    }

    public function DownloadPdf(){
        if (session::has("id")){
        $all_notes =$this->liste_note();
        $pdf = PDF::loadView('note_pdf', compact("all_notes"));
        return $pdf->download('note_list.pdf');
    } else return redirect(route('SignUp'));

}

}
