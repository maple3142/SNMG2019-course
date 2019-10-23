$(document).ready(function() {
    // 把中文當兩個英文字母計算長度
    function len(str) {
        return str.replace(/[^\x00-\xff]/g, "xx").length;
    }

    function boring_check(str) {
        var newStr = str.replace(/\s+/g, "");
        if (newStr == "'or1=1--" || newStr == "'or1=1#") {
            alert("j00_4r3_5up3r_H4x0r!");
            return false;
        }
        return true;
    }

    function append_table() {
        $val = $("#input_bar").val();
        if (!boring_check($val) || len($val) <= 0) return;
        else if (len($val) > 60) {
            alert("Your comment is too long!!!!!!!!!!!");
            return;
        }
        // 在 table 裡面插入一行 <tr> ... </tr> 代表新增的事項
        $("table").append(
            "<tr><td><p>yabasu</p></td><td><p>" +
                $val +
                '</p></td><td><button class="delete_btn">Delete</button></td></tr>'
        );
        // 上面 $("#input_bar").val() 是用來取得目前 #input_bar 裡面填入的文字

        // 清空輸入框 #input_bar 裡面的文字
        $("#input_bar").val("");
    }
    // 當 #submit_btn 被按下的時候，做...
    $(document).on("click", "#submit_btn", function(event) {
        append_table();
    });

    //  當 .delete_btn 被按下的時候，做...
    $(document).on("click", ".delete_btn", function(event) {
        //刪除觸發事件的按鈕的父元素中的<tr>標籤
        $(this)
            .parents("tr")
            .remove();
    });

    // 當在輸入時按下鍵盤上的按鈕
    $(document).on("keypress", "#input_bar", function(event) {
        //如果按下的是Enter
        if (event.key === "Enter") {
            append_table();
        }
    });
});
