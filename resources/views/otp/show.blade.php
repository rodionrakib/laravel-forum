@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Send Otp</div>

                    <div class="card-body">
                        <form action="http://sms.sslwireless.com/pushapi/dynamic/server.php" method="post">

                            <input  type="hidden" value="Softwind_tech" name="user" />
                            <input  type="hidden" value="23#jkQnsuF4@" name="pass" />
                            <input  type="hidden" value="Softwindnonmask" name="sid" />

                            <input  type="hidden" value="8801539542041" name="sms[0][0]" />
                            <input  type="hidden" value="Test SMS One" name="sms[0][1]" />
                            <input  type="hidden" value="123456789" name="sms[0][2]" />


                            <input type="submit" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
