<div class='col1' id="rankings_index">


    <h1> Are you supporting the conflict Mineral War in Eastern Congo?</h1><br>

    <p>At CMBUZZ, we developed a friendly CM-free tool  to give you an insight on what actions companies are
            (or are not)
            taking to contribute to the creation of a clean minerals trade in Congo, and ultimately, the reduction of
            conflict there.<br><br>
    </p>


        <h2>Find out now by enter information about a device you own, in the form below.</h2>


        <h3>Select a type, model and make for your device to find out if your device could potentially be part of the problem.
            Use your consumer power to make more responsible purchasing decisions.</h3>

        <div class='about_your_device'>

            <form>
                <div id="cm_tool">Device Conflict Minerals tool</div>
                <p>Select A device type you own: </p>
                <select id='device_type' name='id'>
                    <option value=""> Select a device</option>

                    <?php foreach ($device_types as $type): ?>

                        <option value="<?= $type['id'] ?>"> <?= $type['name'] ?></option>

                    <?php endforeach; ?>

                </select>
                <p>Select the manufacturer for your device: </p>
                <select id='company_id' name="company_id">

                    <?php foreach ($company_names as $name): ?>

                        <option value="<?= $name['company_id'] ?>"> <?= $name['company_name'] ?></option>

                    <?php endforeach; ?>

                </select>
                <input type='button' id="score" value='Add Device'>
                <div id='company_score'></div>
                <div id='result'></div>
            </form>
        </div>
    <div id='number_of_devices_owned'></div>

</div>


        <div class='col2'>
            <img src='/images/rankings_legend.png' alt="status_legend">

          <div id='score_credit'> <p> All the rankings and company scores have been determined by <a href="http://raisehopeforcongo.org/content/conflict-minerals-company-rankings">Enough Project,</a>on their efforts toward
            using and investing in conflict-free minerals in their products.</p>
          </div>

        </div>
