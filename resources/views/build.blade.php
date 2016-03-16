@extends('app')

@section('content')
<div class="w-section">
    <div class="w-section section hero success">
        <div class="w-container container">
            <h2>Build a Bubble Board</h2>
            <p>(It's so easy)</p>
        </div>
    </div>
</div>
<div class="w-section">
    <div class="w-container asdasd">
        <div class="w-form">
            {!! Form::open( ['url'=>'build/']) !!}
            <div class="w-clearfix form-mid{{$errors->has('boardname')?'red has-error':''}}">
                <div class="subtitle">Hey {{ auth()->user()->name }}, lets make a Bubble Board!</div>
                <div class="boardname">Board name:</div>
                <dfn data-info="Board name must be min 2 - 50 characters and unique.">?</dfn>
                <input id="boardname" required value="{{ old('boardname') }}"  type="text" placeholder="Enter your board name" name="boardname" data-name="Boardname 2" class="w-input board-name">
                {!! $errors->first('boardname','<span class="help-block">:message</span>') !!}

                <div class="boardname">Board blurb:</div>
                <dfn data-info="A description of your board for all your users. Maximum 250 characters.">?</dfn>

                <input id="board-5" value="{{ old('boardblurb') }}" type="text" placeholder="Enter the board purpose" name="boardblurb" data-name="Board 5" class="w-input board-name">
                {!! $errors->first('boardblurb','<span class="help-block">:message</span>') !!}
                <div class="subtitle">Decide how people enter your board:</div>


                <div class="w-row">
                    <div class="w-col w-col-6">

                        <div class="w-checkbox checkboxfield">


                            <input id="PincodeCheckbox" type="checkbox" name="Email-10" data-name="Email 10"  class="w-checkbox-input checkbox" checked>

                            <label for="PincodeCheckbox" class="w-form-label checkboxtext">Password</label>
                            <dfn data-info="People simply enter your board's password to gain access to it. It must be 2 - 50 characters and unique.">?</dfn>

                            <div class="reveal-if-active">
                                <label class="boardname" for="board-6">Set your boards password:</label>

                                <input id="board-6" value="{{ old('pincode') }}" data-require-pair="#PincodeCheckbox" type="text" placeholder="Enter an awesome password" name="pincode" data-name="Board 6" class="require-if-active w-input board-name{{$errors->has('boardname')?'red has-error':''}}">
                                {!! $errors->first('pincode','<span class="help-block">:message</span>') !!}
                            </div>




                        </div>

                    </div>
                    <div class="w-col w-col-6">
                        <div class="w-checkbox checkboxfield">
                            <input id="Email-11" type="checkbox" name="Email-11" data-name="Email 11" class="w-checkbox-input checkbox">
                            <label for="Email-11" class="w-form-label checkboxtext greyedout">Work Email</label>

                            <dfn data-info="You will soon be able to restrict your board to only employees using their email accounts.">?</dfn>
                            <div class="reveal-if-active">
                                <label for="which-dog">Sorry this isn't available yet :(</label>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-row">
                    <div class="w-col w-col-4">
                        <div class="w-checkbox checkboxfield">
                            <input id="Email-16" type="checkbox" name="Email-16" data-name="Email 16" class="w-checkbox-input checkbox">
                            <label for="Email-16" class="w-form-label checkboxtext greyedout">QR Codes</label>
                            <div class="reveal-if-active">
                                <label for="which-dog">Sorry this isn't available yet :(</label>

                            </div>
                        </div>
                    </div>
                    <div class="w-col w-col-4">
                        <div class="w-checkbox checkboxfield">
                            <input id="Email-14" type="checkbox" name="Email-14" data-name="Email 14" class="w-checkbox-input checkbox">
                            <label for="Email-14" class="w-form-label checkboxtext greyedout">Timed Pincodes</label>
                            <div class="reveal-if-active">
                                <label for="which-dog">Sorry this isn't available yet :(</label>

                            </div>
                        </div>
                    </div>
                    <div class="w-col w-col-4">
                        <div class="w-checkbox checkboxfield">
                            <input id="Email-15" type="checkbox" name="Email-15" data-name="Email 15" class="w-checkbox-input checkbox">
                            <label for="Email-15" class="w-form-label checkboxtext greyedout">GPS Location</label>
                            <div class="reveal-if-active">
                                <label for="which-dog">Sorry this isn't available yet :(</label>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- <div class="subtitle">Use a pin code for people to enter:</div><a href="#" class="w-button pingenerate">Randomly Generate Pin&nbsp;</a>
                <input id="board-6" type="text" placeholder="Enter a pin or get a random one" name="pincode" data-name="Board 6" class="w-input board-name{{$errors->has('boardname')?'red has-error':''}}">
                {!! $errors->first('pincode','<span class="help-block">:message</span>') !!}
                <div> -->
                    {{--<div class="subtitle">Board admin alias (automatically you!):</div>
                    <input id="adminbx" type="text" value="{{ auth()->user()->name }}" name="admin" data-name="Board 7" class="w-input board-name">
                </div>--}}
                <input type="submit" value="Generate Your Bubble Board!" data-wait="Please wait..." class="w-button generateboard">
            {!! Form::close() !!}
            </div>

        </div>
    </div>
    <div class="w-container contosinerf"></div>
</div>
<div class="w-container">
    <div class="blurbtext">It's that easy! Check out some of our <a class="basiclink" href="{{ url('/about') }}">advance features</a> coming soon.</div>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="js/webflow.js"></script>
<!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->


<!--scipt for checkboxreveal-->
<script>
    var FormStuff = {

        init: function() {
            // kick it off once, in case the radio is already checked when the page loads
            this.applyConditionalRequired();
            this.bindUIActions();
        },

        bindUIActions: function() {
            // when a radio or checkbox changes value, click or otherwise
            $("input[type='radio'], input[type='checkbox']").on("change", this.applyConditionalRequired);
        },

        applyConditionalRequired: function() {
            // find each input that may be hidden or not
            $(".require-if-active").each(function() {
                var el = $(this);
                // find the pairing radio or checkbox
                if ($(el.data("require-pair")).is(":checked")) {
                    // if its checked, the field should be required
                    el.prop("required", true);
                } else {
                    // otherwise it should not
                    el.prop("required", false);
                }
            });
        }

    };

    FormStuff.init();
</script>


</body>
</html>
@endsection