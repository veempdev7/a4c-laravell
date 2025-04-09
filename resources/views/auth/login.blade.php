@extends('layouts.app')

@section('content')
<div class="container">
    <table width="100%" border="0">
        <!-- Header -->
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1">
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0" bgcolor="#5082B2">
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <img src="{{ asset('clientconvertgraphics2016/a4conlinelogo250.png') }}" width="250" height="92" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td height="10"></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Login Form -->
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#F1F1F1">
                    <tr>
                        <td align="right">
                            <div align="center">
                                <table width="1000" border="0" bgcolor="#FFFFFF">
                                    <tr>
                                        <td>
                                            <table width="100%" height="400" background="{{ asset('clientconvertgraphics2016/skyplane1400.png') }}">
                                                <tr>
                                                    <td width="5%">&nbsp;</td>
                                                    <td width="90%" align="center" valign="middle">
                                                        <form method="POST" action="{{ route('loginapp.login') }}">
                                                            @csrf
                                                            <table width="320" border="0">
                                                                <tr>
                                                                    <td>
                                                                        <!-- Username Field -->
                                                                        <input type="text" name="kt_login_user" id="kt_login_user" value="{{ old('kt_login_user') }}" size="32" placeholder="Username" class="form-control">
                                                                        @error('kt_login_user')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                </tr>

                                                                <tr class="v-10-b-666666 get_otp_tr">
                                                                    <td>
                                                                        <div class="form-group mt-4 row">
                                                                            <div class="col-sm-6">
                                                                                <button type="button" class="btn btn-primary otp_btn" id="get_otp">Get OTP</button>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <!-- OTP Field -->
                                                                <tr>
                                                                    <td>
                                                                        <input type="text" name="a4c_verify_otp" id="a4c_verify_otp" size="32" placeholder="OTP" class="form-control">
                                                                        @error('a4c_verify_otp')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                </tr>

                                                                <!-- Password Field -->
                                                                <tr>
                                                                    <td>
                                                                        <input type="password" name="kt_login_password" id="kt_login_password" size="32" placeholder="Password" class="form-control">
                                                                        @error('kt_login_password')
                                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                                        @enderror
                                                                    </td>
                                                                </tr>

                                                                <!-- Remember Me Checkbox -->
                                                                <tr>
                                                                    <td>
                                                                        <label>
                                                                            <input type="checkbox" name="kt_login_rememberme" id="kt_login_rememberme" value="1" {{ old('kt_login_rememberme') ? 'checked' : '' }}>
                                                                            Remember me
                                                                        </label>
                                                                    </td>
                                                                </tr>

                                                                <tr class="v-10-b-666666">
                                                                    <td align="right">
                                                                        <button type="submit" class="btn btn-primary">Login</button>
                                                                        <a href="https://help.air4casts.com" target="_blank" class="forgot_link">?</a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td>
                <table width="100%" border="0" bgcolor="#E1E1E1">
                    <tr>
                        <td>
                            <div align="center">
                                <table width="1000" border="0">
                                    <tr>
                                        <td>
                                            <table width="100%" border="0" bgcolor="#5082B2">
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table width="100%" border="0">
                                                            <tr>
                                                                <td width="5%">&nbsp;</td>
                                                                <td width="6%" class="emmahelveticaa12white"><a href="https://help.air4casts.com" target="_blank" class="emmahelveticaa12white">Contact</a></td>
                                                                <td width="7%" class="emmahelveticaa12white"><a href="http://www.air4casts.com/support/aboutus.php" class="emmahelveticaa12white">About Us</a></td>
                                                                <td width="12%" class="emmahelveticaa12white"><a href="https://help.air4casts.com" target="_blank" class="emmahelveticaa12white">Terms & Conditions</a></td>
                                                                <td width="48%">&nbsp;</td>
                                                                <td width="10%" class="emmahelveticaa12white"><div align="right">Copyright {{ date('Y') }}</div></td>
                                                                <td width="1%" class="emmahelveticaa12white"><div align="center">|</div></td>
                                                                <td width="6%" class="emmahelveticaa12white"><a href="http://www.air4casts.com/" class="emmahelveticaa12white">Air4casts</a></td>
                                                                <td width="5%">&nbsp;</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
@endsection
