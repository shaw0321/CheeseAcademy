
console.log("読み込みました");

// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.0/firebase-app.js";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

import { getDatabase, ref, push, set, onChildAdded, remove, onChildRemoved }
    from "https://cdnjs.cloudflare.com/ajax/libs/firebase/9.6.0/firebase-database.min.js";

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyAI3GUfkngW-pUkYydXpXqEgYs3MqxW__Q",
  authDomain: "gsapp-cb6e9.firebaseapp.com",
  projectId: "gsapp-cb6e9",
  storageBucket: "gsapp-cb6e9.appspot.com",
  messagingSenderId: "208815022139",
  appId: "1:208815022139:web:9cc201aadcca3c8ceffc1e"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
// console.log(app);

const db = getDatabase(app);


// 指定したIDに新たなオブジェクトを追加する関数
export function Create(path,object){
    const newPostRef = push(ref(db, path));
        set(newPostRef, object);

}


// DBにあるオブジェクトを取得して、返す関数



// ログイン関する処理を書く
// id,PWが取得したオブジェクト内に存在するか判定し存在する場合はtrue、しない場合はfalse



// 存在確認に関する処理を書く
// 同じidが取得したオブジェクトに存在しない場合は登録する、存在する場合はalertを返す

// export function isExist(){

//     // オブジェクトを取得し、格納する
//     const object = ~~~~

//     // 引数が対象に含まれるか確認する
//     // 含まれる場合はtrueを返す、含まれない場合はfalseを返す
// }



    //chatRowを生成する関数
    function creatChatRow(data, a,target){
        const msg =data.val();
        // オブジェクトのkeyを取得
        const key = data.key;

        let isMyself =  a;
        console.log(a);

        console.log(isMyself);

        let h =
            `<li class="chatRow ${isMyself}" value="${key}">
                <div class="iconArea">
                    <span class="icon">写真</span>
                </div>
                <div class="contentArea">
                    <div class="nameArea">
                        ${msg.uname}
                    </div>
                    <div class="messageArea">
                        ${msg.text}
                    </div>
                </div>
                <div class="dateArea">
                    <dv class="year_month_day">
                        ${msg.year}/${msg.month}/${msg.day}
                    </dv>
                    <dv class= "hour_minute">
                        ${msg.hour}:${msg.minute}
                    </dv>
                </div>

                <div class="deleteArea">
                    <button id="delete" class= ${key}>削除</button>
                </div>
            </li>`;

            console.log(isMyself);

        $(target).append(h);
    } 


    // チャット履歴を返す関数

    export function addChat(sourse,target, username){

        onChildAdded(ref(db,sourse), function(data){

            // unameが自分だった時の処理
            if(data.val().uname == username){
              creatChatRow(data, "myself",target);
    
            // unameが他人だった時の処理
            }else{
                creatChatRow(data, "others", target);
            }
        })


    }

    






