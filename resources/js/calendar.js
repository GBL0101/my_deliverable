// import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";
import axios from 'axios'; 
// idがcalendarのDOMを取得


var calendarEl = document.getElementById("calendar");

// カレンダーの設定
let calendar = new Calendar(calendarEl, {
    plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],

    // 最初に表示させる形式
    initialView: "timeGridWeek",
    
    timeZone: "Asia/Tokyo",
    // ヘッダーの設定（左/中央/右）
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridYear,dayGridMonth,timeGridWeek,timeGridDay",
    },
    
    // allDaySlot = False,?????????
    
    
    selectable: true,  // 複数日選択可能
    select: function (info) {  // 選択時の処理
        const eventName = prompt("イベントを入力してください");
        
        // 入力された時に実行される
        if (eventName) {
            axios
                .post("/calendar", {
                    start_date: info.start.valueOf(),
                    end_date: info.end.valueOf(),  //ボタンで入力する
                    name: eventName,
                })
                .then((response) => {
                    // イベントの追加
                    calendar.addEvent({
                        id: response.data.id,
                        title: eventName,
                        start: info.start,
                        end: info.end,
                        allDay: false,
                    });
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("登録に失敗しました");
                });
        }
    },
    
    
    events: function (info, successCallback, failureCallback) {
        axios
            .post("/calendar/event", {
                start_date: info.start.valueOf(),
                end_date: info.end.valueOf(),
            })
            .then(response => {
                // 追加したイベントを削除
                calendar.removeAllEvents();
                // カレンダーに読み込み
                successCallback(response.data);
            })
            .catch(() => {
                // バリデーションエラーなど
                alert("取得に失敗しました");
            });
    },
    
    
});

// レンダリング
calendar.render();