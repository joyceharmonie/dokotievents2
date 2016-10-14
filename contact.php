<?php
echo '<body>';
include 'includes/head.php';
include 'includes/header.php';

include 'includes/slider.php';
?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets" style="padding: 50px">
    <div class="row text-center">
        <div class="col-sm-4">
            <div class="contact-detail-box">
                <i class="fa fa-th fa-3x text-colored"></i>
                <h4>Restons en contact</h4>
                <abbr title="Phone">P:</abbr> (123) 456-7890<br>
                E: <a href="mailto:email@email.com" class="text-muted">contact@dokoti.com</a>
            </div>
        </div><!-- end col -->

        <div class="col-sm-4">
            <div class="contact-detail-box">
                <i class="fa fa-map-marker fa-3x text-colored"></i>
                <h4>Où nous sommes</h4>

                <address>
                    8-10 rue étienne marey,<br>
                    PARIS, 75020<br>
                </address>
            </div>
        </div><!-- end col -->

        <div class="col-sm-4">
            <div class="contact-detail-box">
                <i class="fa fa-book fa-3x text-colored"></i>
                <h4>Devis</h4>


                <p>Devis sous 48H.</p>
                <h4 class="text-muted">Pour vos petits et grands projets</h4>
            </div>
        </div><!-- end col -->

    </div>
    <!-- end row -->


    <div class="row">
        <div class="col-sm-6">
            <div class="contact-map">
                <iframe style="height:100%;width:100%;border:0;" frameborder="0" src="https://www.google.com/maps/embed/v1/place?q=8+Rue+Etienne+Marey,+Paris,+France&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>
            </div>
        </div><!-- end col -->

        <!-- Contact form -->
        <div class="col-sm-6">
            <form role="form" name="ajax-form" id="ajax-form" action="https://formsubmit.io/send/coderthemes@gmail.com" method="post" class="form-main">

                <div class="form-group">
                    <label for="name2">Name</label>
                    <input class="form-control" id="name2" name="name" onblur="if(this.value == '') this.value='Name'" onfocus="if(this.value == 'Name') this.value=''" type="text" value="Name">
                    <div class="error" id="err-name" style="display: none;">Please enter name</div>
                </div> <!-- /Form-name -->

                <div class="form-group">
                    <label for="email2">Email</label>
                    <input class="form-control" id="email2" name="email" type="text" onfocus="if(this.value == 'E-mail') this.value='';" onblur="if(this.value == '') this.value='E-mail';" value="E-mail">
                    <div class="error" id="err-emailvld" style="display: none;">E-mail is not a valid format</div>
                </div> <!-- /Form-email -->

                <div class="form-group">
                    <label for="message2">Message</label>
                    <textarea class="form-control" id="message2" name="message" rows="5" onblur="if(this.value == '') this.value='Message'" onfocus="if(this.value == 'Message') this.value=''">Message</textarea>

                    <div class="error" id="err-message" style="display: none;">Please enter message</div>
                </div> <!-- /col -->

                <div class="row">
                    <div class="col-xs-12">
                        <div id="ajaxsuccess" class="text-success">E-mail was successfully sent.</div>
                        <div class="error" id="err-form" style="display: none;">There was a problem validating the form please check!</div>
                        <div class="error" id="err-timedout">The connection to the server timed out!</div>
                        <div class="error" id="err-state"></div>
                        <button type="submit" class="btn btn-primary btn-shadow btn-rounded w-md" id="send">Submit</button>
                    </div> <!-- /col -->
                </div> <!-- /row -->

            </form> <!-- /form -->
        </div> <!-- end col -->

    </div> <!-- end row -->

</div>