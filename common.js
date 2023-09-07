
var script = document.createElement('script');
script.src = '/js/testComm.js'; // 'testComm.js'의 경로를 지정합니다.
document.head.appendChild(script);


// 입력값이 비어있는지 검사하는 함수
function isEmpty(value) {
    if (value.trim() === "" || value == null || value == undefined) {
        return true;
    } else {
        return false;
    }
}

// 입력값의 길이가 특정 길이를 초과하는지 검사하는 함수
function isOverLength(value, maxLength) {
    if (value.length > maxLength) {
        return true;
    } else {
        return false;
    }
}

// 게시글 작성 시 입력 검사
function validateBoardWrite() {
    const title = document.getElementById("utitle").value;
    const writer = document.getElementById("uwriter").value;
    const content = document.getElementById("ucontent").value;

    if (isEmpty(title) || isEmpty(writer) || isEmpty(content)) {
        alert("모든 필드를 입력해주세요.");
        console.log("모든 필드를 입력해주세요.");
        return false;
    }

    if (isOverLength(title, 200) || isOverLength(writer, 100)) {
        alert("제목은 200자 이하, 작성자는 100자 이하로 입력해주세요.");
        return false;
    }

    return true;
}

// 게시글 작성 버튼 클릭 시 검사 함수 호출
document.querySelector("button[type='submit']").addEventListener("click", function(event) {
    if (!validateBoardWrite()) {
        event.preventDefault();
    }
});
