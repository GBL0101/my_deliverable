// import '@fullcalendar/core/vdom'; // （for Vite）ver6には不要なので、エラーが出たらここを消す。
import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";
import axios from 'axios'; 
// idがcalendarのDOMを取得


function formatDate(date, pos) {
    const dt = new Date(date);
    if(pos==="end"){
        dt.setDate(dt.getDate() - 1);
    }
    return dt.getFullYear() + '-' +('0' + (dt.getMonth()+1)).slice(-2)+ '-' +  ('0' + dt.getDate()).slice(-2);
}


const calendarEl = document.getElementById("calendar");


if(calendarEl){
    // カレンダーの設定
    let calendar = new Calendar(calendarEl, {
        plugins: [interactionPlugin, dayGridPlugin, timeGridPlugin],
    
        // 最初に表示させる形式
        initialView: "timeGridWeek",
        
        timeZone: "Asia/Tokyo",
        
        customButtons: { // カスタムボタン
            eventAddButton: { // 新規予定追加ボタン
                text: '予定を追加',
                click: function() {
                    // 初期化（以前入力した値をクリアする）
                    document.getElementById("new-id").value = "";
                    document.getElementById("new-name").value = "";
                    document.getElementById("new-start_time").value = "";
                    document.getElementById("new-end_time").value = "";
                    // document.getElementById("new-event_body").value = "";
                    // document.getElementById("new-event_color").value = "blue";
    
                    // 新規予定追加モーダルを開く
                    document.getElementById('modal-add').style.display = 'flex';
                }
            }
        },
        
        
        // ヘッダーの設定（左/中央/右）
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "eventAddButton dayGridYear,dayGridMonth,timeGridWeek,timeGridDay",
        },
        
        height: "auto",
        
        // allDaySlot = False,?????????
        
        
        selectable: true,  // 複数日選択可能
        select: function (info) {  // 選択時の処理
            const eventName = prompt("イベントを入力してください");
            
            // 入力された時に実行される
            if (eventName) {
                axios
                    .post("/teacher/calendar", {
                        start_time: info.start.valueOf(),
                        end_time: info.end.valueOf(),  //ボタンで入力する
                        name: eventName,
                    })
                    .then((response) => {
                        // console.log(response)
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
                .post("/teacher/calendar/event", {
                    start_time: info.start.valueOf(),
                    end_time: info.end.valueOf(),
                })
                .then(response => {
                    console.log(response.data.shift.concat(response.data.class));
                    // 追加したイベントを削除
                    calendar.removeAllEvents();
                    // カレンダーに読み込み\
                    successCallback(response.data.shift.concat(response.data.class));
                    // successCallback(response.data.class);
                    
                    
                })
                .catch(() => {
                    // バリデーションエラーなど
                    alert("取得に失敗しました");
                });
        },
        
        eventClick: function(info){
            window.alert(info.event.id);
            document.getElementById("id").value = info.event.id;
            document.getElementById("name").value = info.event.title;
            // document.getElementById("start_time").value = info.event.start;
            // document.getElementById("end_time").value = info.event.end;
            // document.getElementById("event_body").value = info.event.extendedProps.description;
            // document.getElementById("event_color").value = info.event.backgroundColor;
    
            // 予定編集モーダルを開く
            document.getElementById('modal-update').style.display = 'flex';
            
        }
        
        
    });
    
    // レンダリング
    calendar.render();
    
    window.closeAddModal = function(){
        document.getElementById('modal-add').style.display = 'none';
    }
    
    window.closeUpdateModal = function(){
        document.getElementById('modal-update').style.display = 'none';
    }
}