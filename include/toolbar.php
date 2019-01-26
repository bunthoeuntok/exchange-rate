<div class="toolbar-controller">
    <div class="style-search">
        <div class="action">
            <a modal-data="modal" class="waves-effect waves-ligth show-modal btn btn-small add-new" id="add" style=""><i
                        class="material-icons left">add</i>add new</a>
        </div>
        <div class="actions">
            <a modal-data="modal" class="waves-effect waves-ligth show-modal btn btn-small orange edit" id="edit"><i
                        class="material-icons left">edit</i>edit</a>
            <a class="waves-effect waves-ligth btn btn-small red" id="delete"><i class="material-icons left">delete</i>delete</a>
        </div>
    </div>
    <div class="style-search">
        <input style="color: #666; font-weight: 400; background: #fff; height: 40px" id="search" type="text"
               class="validate-small no-margin" name="search" placeholder="Search...">
    </div>
    <!-- <div class="none">
        <form method="post" action="app/controllers/ReportController.php" id="search">
            <div class="boxs-report">
                <div class="box-report">
                    <select name="user_id" id="user_id">
                        <option value="Male">All</option>
                        <option value="Male">Tok Bunthoeun</option>
                        <option value="Female">Roeun Chamnab</option>
                    </select>
                </div>
                <div class="box-report">
                    <input name="start_date" placeholder="Start Date" class="date" type="text" data-format="Y-m-d"
                           data-large-default="true" data-theme="my-style" data-large-mode="true"
                           data-translate-mode="true"/>

                </div>
                <div class="box-report">
                    <input name="end_date" placeholder="End Date" class="date" type="text" data-format="Y-m-d"
                           data-large-default="true" data-theme="my-style" data-large-mode="true"
                           data-translate-mode="true"/>
                </div>
                <div class="box-report">
                    <button type="submit" class="btn btn-small waves-effect waves-ligth">Search</button>
                </div>

            </div>
        </form>
    </div> -->
</div>
<div class="modal modal-small alert">
    <div class="modal-card">
        <div class="modal-card-body" style="">
            <div class="" style="width: 100%;display: flex;justify-content: center;">
                <img src="static/images/icons/exclamation.png" alt="">
            </div>
            <p>
                Are you sure that you want to permanently delete the selected item
            </p>
        </div>
        <div class="modal-card-foot" style="display: flex; justify-content: center; padding: 24px; padding-bottom: 30px;">
            <button class="btn-small grey closealert">cancel</button>
            <button class="btn-small delete red">yes delete it</button>
        </div>
    </div>
</div>