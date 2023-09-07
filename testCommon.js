// isEmpty 함수 테스트
function testIsEmpty() {
    console.assert(isEmpty("") === true, "빈 문자열 테스트 실패");
    console.assert(isEmpty("   ") === true, "공백 문자열 테스트 실패");
    console.assert(isEmpty("test") === false, "일반 문자열 테스트 실패");
}

// isOverLength 함수 테스트
function testIsOverLength() {
    console.assert(isOverLength("test", 5) === false, "5자 미만 문자열 테스트 실패");
    console.assert(isOverLength("testing", 5) === true, "5자 초과 문자열 테스트 실패");
}

// 테스트 실행
function runTests() {
    testIsEmpty();
    testIsOverLength();
    console.log("모든 테스트가 완료되었습니다.");
}

// 테스트 스크립트 실행
runTests();
