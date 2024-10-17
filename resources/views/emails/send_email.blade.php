<!doctype html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Simple Transactional Email</title>
    <style media="all" type="text/css">
@media all {
  .btn-primary table td:hover {
    background-color: #ec0867 !important;
  }

  .btn-primary a:hover {
    background-color: #ec0867 !important;
    border-color: #ec0867 !important;
  }
}
@media only screen and (max-width: 640px) {
  .main p,
  .main td,
  .main span {
    font-size: 16px !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .wrapper {
    padding: 8px !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .content {
    padding: 0 !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .container {
    padding: 0 !important;
    padding-top: 8px !important;
    width: 100% !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .main {
    border-left-width: 0 !important;
    border-radius: 0 !important;
    border-right-width: 0 !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .btn table {
    max-width: 100% !important;
    width: 100% !important;
    text-align: center;
    text-align: -webkit-center;
  }

  .btn a {
    font-size: 16px !important;
    max-width: 100% !important;
    width: 100% !important;
    text-align: center;
    text-align: -webkit-center;
  }
}
@media all {
  .ExternalClass {
    width: 100%;
  }

  .ExternalClass,
  .ExternalClass p,
  .ExternalClass span,
  .ExternalClass font,
  .ExternalClass td,
  .ExternalClass div {
    line-height: 100%;
  }

  .apple-link a {
    color: inherit !important;
    font-family: inherit !important;
    font-size: inherit !important;
    font-weight: inherit !important;
    line-height: inherit !important;
    text-decoration: none !important;
  }

  #MessageViewBody a {
    color: inherit;
    text-decoration: none;
    font-size: inherit;
    font-family: inherit;
    font-weight: inherit;
    line-height: inherit;
  }
}
</style>
  </head>
  <body style="text-align: center;font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f4f5f6; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f4f5f6; width: 100%;" width="100%" bgcolor="#f4f5f6">
      <tr>
        <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;" width="600" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
            <!-- START CENTERED WHITE CONTAINER -->
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border: 1px solid #eaebed; border-radius: 16px; width: 100%;" width="100%">
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 24px;" valign="top">
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;"><img src="{{ $message->embed(app_settings()->logo ? public_path().'/'.app_settings()->logo : public_path() . '/assets/mark-rise-logo-01.png') }}" title="Logo" alt="{{ asset(app_settings()->logo ?? 'assets/mark-rise-logo-01.png') }}"></p>
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;direction: rtl;">{{ $data['welcome_msg'] }}&nbsp;{{$data['user_name']}}&nbsp;@lang("to Themarkrise")</p>
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">@lang("Thank you for subscribing to us")</p>
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">{!! $data['content'] !!}</p>
                  <!-- <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="text-align: center;border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%;" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="text-align: center;text-align: -webkit-center;font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 16px;" valign="top">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                            <tbody>
                              <tr>
                                <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; border-radius: 4px; text-align: center; background-color: #0867ec;" valign="top" align="center" bgcolor="#0867ec">
                                  <a href="http://htmlemail.io" target="_blank" style="border: solid 2px #0867ec; border-radius: 4px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 16px; font-weight: bold; margin: 0; padding: 12px 24px; text-decoration: none; text-transform: capitalize; background-color: #0867ec; border-color: #0867ec; color: #ffffff;">Call To Action</a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table> -->
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">@lang("Thanks")<br />@lang("Team")&nbsp;{{$data['project_name']}} !</p>
                  <!-- social media  -->
                  {{-- <table cellpadding="0" cellspacing="0" class="es-footer" align="center">
                    <tr>
                        @foreach (app_social() as $social)
                            @if ($social->type == "facebook")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/facebook.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Youtube" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "google-plus")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/google-plus.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Instagram" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "instagram")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/instagram.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Instagram" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "linkedin")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/linkedin.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Instagram" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "snapchat-ghost")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/snapchat-ghost.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Instagram" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "tiktok")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/tiktok.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Instagram" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "twitter")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/twitter.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Twitter" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "facebook")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/facebook.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Facebook" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "whats")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/whats.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Facebook" height="24" width="24">
                                    </a>
                                </td>
                            @elseif($social->type == "youtube")
                                <td align="center" valign="top" class="es-p10r">
                                    <a target="_blank" href="{{$social->value}}" title="{{$social->type}}">
                                        <img src="{{ $message->embed(public_path() . '/assets/social_icons/youtube.png') }}" style="margin-right: 5px;margin-left: 5px;" alt="{{$social->type}}" title="Facebook" height="24" width="24">
                                    </a>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                </table> --}}
                </td>
              </tr>
              <!-- END MAIN CONTENT AREA -->
              </table>
            <!-- START FOOTER -->
            <div class="footer" style="clear: both; padding-top: 24px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                {{-- <tr>
                  <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #9a9ea6; font-size: 16px; text-align: center;">Company Inc, 7-11 Commercial Ct, Belfast BT1 2NB</span>
                    <br> Don't like these emails? <a href="http://htmlemail.io/blog" style="text-decoration: underline; color: #9a9ea6; font-size: 16px; text-align: center;">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #9a9ea6; font-size: 16px; text-align: center;" valign="top" align="center">
                    Powered by <a href="http://htmlemail.io" style="color: #9a9ea6; font-size: 16px; text-align: center; text-decoration: none;">HTMLemail.io</a>
                  </td>
                </tr> --}}
              </table>
            </div>
            <!-- END FOOTER -->
          </div>
        </td>
        <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
