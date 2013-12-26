<div class=col1 id="index_intro">
    <?php if ($user): ?>

        <h1> Welcome to Conflict Minerals BUZZ (CMBUZZ)</h1>
        <h2>A conflict Minerals-free online social community</h2>

        <p>
            For each electronic devices registered at CMBUZZ, you gain an average status score that corresponds to the
            average scores assigned to your manufacturer.
            The score represents efforts made by the manufacturer toward eliminating conflict minerals out of
            electronics production.
            <br>

            Stretch it further by following your friends based on their conflict Minerals status!
            <br>
        </p>


        <h2>Now that you are part of our community, check out your device(s) <a
                href="/rankings/index">here</a> for potential Conflict minerals</h2>

        <div id='3T_pics'>
            <img src='/images/Tantanlum.jpg' alt='tantalum'>
            <img src='/images/Tungsten.JPG' alt='tungsten'>
            <img src='/images/Tin.jpg' alt="tin">
        </div><!--end of 3T-pics-->

        <!-- Menu options for users who are not logged in -->
    <?php else: ?>


        <h1> Welcome to Conflict Minerals BUZZ (CMBUZZ)</h1>
        <h2>A conflict Minerals-free online social community</h2>

        <p>
            For each electronic devices registered at CMBUZZ, you gain an average status score that corresponds to the
            average scores assigned to your manufacturer.
            The score represents efforts made by the manufacturer toward eliminating conflict minerals out of
            electronics production.
            <br>

            Stretch it further by following your friends based on their conflict Minerals status!
            <br>
        </p>

        <p>
            <a href="/users/login">Login </a> or <a href='/users/Signup'>Signup </a> to find out how to Buzz the 3Ts out
            of your devices!
        </p>

        <div id='3T_pics'>
            <img src='/images/Tantanlum.jpg' alt='tantalum'>
            <img src='/images/Tungsten.JPG' alt='tungsten'>
            <img src='/images/Tin.jpg' alt="tin">

            <p>Learn more about <a href="http://en.wikipedia.org/wiki/Coltan"> Coltan</a>

        </div><!--end of 3T's pics-->

    <?php endif; ?>

</div> <!--end of index_intro-->

<div class='col2'>

    <h2>Your CMBUZZ Status Legend:</h2>

    <div id='legend_left'>
        <div id='green' class='key_legend'></div>
        <div id='yellow' class='key_legend'></div>
        <div id='red' class='key_legend'></div>
        <div id='blank' class='key_legend'></div>
        <br>
    </div><!--end of legend_lef-->
    <div id='legend_right'>
        <div id=legend_green>Average score: 30 and up</div>
        <div id=legend_yellow> Average score: 16-29</div>
        <div id=legend_red> Average score: 0-15</div>
        <div id=legend_blank>Blank Status : No devices registered</div>
    </div><!--end of legend_right-->
    <br>

    Read more on status key <a href='/rankings/index'>here</a>

</div><!--end of col2-->


