     <main id="form" class="mdl-layout__content" style="display: none;">
        <div class="mdl-card mdl-shadow--6dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Add New Element</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <form action="../dbconnection/form-processor.php" method="post">
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="devicename" />
                <label class="mdl-textfield__label" for="devicename">Name</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="deviceroom" />
                <label class="mdl-textfield__label" for="deviceroom">Room</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="devicedesc" />
                <label class="mdl-textfield__label" for="devicedesc">Description</label>
              </div>
            </div>
            <div class="mdl-card__actions mdl-card--border">
              <input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit" value="Save" name="formSubmit" />
            </form>
            <button id="closed" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">CLOSE</button>
          </div>
        </div>
      </main>

      <main id="form2" class="mdl-layout__content" style="display: none;">
        <div class="mdl-card mdl-shadow--6dp">
          <div class="mdl-card__title mdl-color--primary mdl-color-text--white">
            <h2 class="mdl-card__title-text">Remove Element</h2>
          </div>
          <div class="mdl-card__supporting-text">
            <form action="../dbconnection/form-processor2.php" method="post">
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="devicename" />
                <label class="mdl-textfield__label" for="devicename">Name</label>
              </div>
              <div class="mdl-textfield mdl-js-textfield">
                <input class="mdl-textfield__input" type="text" name="deviceroom" />
                <label class="mdl-textfield__label" for="deviceroom">Room</label>
              </div>
            </div>
            <div class="mdl-card__actions mdl-card--border">
              <input class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" type="submit" value="Save" name="formSubmit" />
            </form>
            <button id="closed2" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">CLOSE</button>
          </div>
        </div>
      </main>

      <div class="menus">
        <button id="meniu" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored">
          <i class="material-icons">reorder</i>
        </button>

        <ul class="mdl-menu mdl-menu--top-right mdl-js-menu mdl-js-ripple-effect"
        for="meniu">
        <li id="plus" class="mdl-menu__item">Add Device</li>
        <li id="remove" class="mdl-menu__item">Remove Device</li>
      </ul>
    </div>

     <script src="../js/clickevents.js"></script>