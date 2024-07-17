<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FullCalendar</title>
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!--studentやteacherなどディレクトリを分けてインポートする-->
    </head>
<body>
    <div id='calendar'></div>
    
    <!--新規追加モーダル-->
    <div id="modal-add" class="modal">
            <div class="modal-contents">
                <form method="POST" action="{{ route('teacher.timetable.store') }}">
                    @csrf
                    <input id="new-id" type="hidden" name="id" value="" />
                    <label for="name">タイトル</label>
                    <input id="new-name" class="input-name" type="text" name="name" value="" />
                    <label for="start_time">開始日時</label>
                    <input id="new-start_time" class="input-time" type="datetime-local" name="start_time" value="" />
                    <label for="end_time">終了日時</label>
                    <input id="new-end_time" class="input-time" type="datetime-local" name="end_time" value="" />
                    <!--<label for="event_body" style="display: block">内容</label>-->
                    <!--<textarea id="new-event_body" name="event_body" rows="3" value=""></textarea>-->
                    <!--<label for="event_color">背景色</label>-->
                    <!--<select id="new-event_color" name="event_color">-->
                    <!--    <option value="blue" selected>青</option>-->
                    <!--    <option value="green">緑</option>-->
                    <!--</select>-->
                    <button type="button" onclick="closeAddModal()">キャンセル</button>
                    <button type="submit">決定</button>
                </form>
            </div>
    </div>
    
    
    <!-- カレンダー編集モーダル -->
        <div id="modal-update" class="modal">
            <div class="modal-contents">
                <form method="POST" action="{{ route('teacher.timetable.update') }}" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="id" value="" />
                    <label for="name">タイトル</label>
                    <input class="input-name" type="text" id="name" name="name" value="" />
                    <!--<label for="start_time">開始日時</label>-->
                    <!--<input class="input-time" type="datetime-local" id="start_time" name="start_time" value="" />-->
                    <!--<label for="end_time">終了日時</label>-->
                    <!--<input class="input-time" type="datetime-local" id="end_time" name="end_time" value="" />-->
                    <!--<label for="event_body" style="display: block">内容</label>-->
                    <!--<textarea id="event_body" name="event_body" rows="3" value=""></textarea>-->
                    <!--<label for="event_color">背景色</label>-->
                    <!--<select id="event_color" name="event_color">-->
                    <!--    <option value="blue">青</option>-->
                    <!--    <option value="green">緑</option>-->
                    <!--</select>-->
                    <button type="button" onclick="closeUpdateModal()">キャンセル</button>
                    <button type="submit">登録</button>
                </form>
            </div>
    </div>
    
    
</body>
</html>

<style scoped>
/* モーダルのオーバーレイ */
.modal{
    display: none; /* モーダル開くとflexに変更（ここの切り替えでモーダルの表示非表示をコントロール） */
    justify-content: center;
    align-items: center;
    position: absolute;
    z-index: 10; /* カレンダーの曜日表示がz-index=2のため、それ以上にする必要あり */
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    height: 100%;
    width: 100%;
    background-color: rgba(0,0,0,0.5);
}
/* モーダル */
.modal-contents{
    background-color: white;
    height: 400px;
    width: 600px;
    padding: 20px;
}

/* 以下モーダル内要素のデザイン調整 */
input{
    padding: 2px;
    border: 1px solid black;
    border-radius: 5px;
}
.input-name{
    display: block;
    width: 80%;
    margin: 0 0 20px;
}
.input-time{
    width: 27%;
    margin: 0 5px 20px 0;
}
textarea{
    display: block;
    width: 80%;
    margin: 0 0 20px;
    padding: 2px;
    border: 1px solid black;
    border-radius: 5px;
    resize: none;
}
select{
    display: block;
    width: 20%;
    margin: 0 0 20px;
    padding: 2px;
    border: 1px solid black;
    border-radius: 5px;
}

.fc-event-title-container{
    cursor: pointer;
}

</style>