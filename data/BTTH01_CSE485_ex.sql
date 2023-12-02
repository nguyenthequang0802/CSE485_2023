SELECT * FROM baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE theloai.ten_tloai = 'Nhạc trữ tình';

SELECT * FROM baiviet
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
WHERE tacgia.ten_tgia = 'Nhacvietplus';

SELECT * FROM baiviet
LEFT JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
WHERE baiviet.ma_tloai IS NULL;

SELECT ma_bviet, tieude AS ten_bviet, ten_bhat, tacgia.ten_tgia, theloai.ten_tloai, ngayviet
FROM baiviet
JOIN theloai ON theloai.ma_tloai = baiviet.ma_tloai
JOIN tacgia ON tacgia.ma_tgia = tacgia.ma_tgia;  

SELECT
    theloai.ten_tloai AS 'Tên thể loại',
    COUNT(baiviet.ma_bviet) AS 'Số bài viết'
FROM
    theloai
LEFT JOIN baiviet ON theloai.ma_tloai = baiviet.ma_tloai
GROUP BY
    theloai.ten_tloai
ORDER BY
    COUNT(baiviet.ma_bviet) DESC
LIMIT 1;

SELECT
    tacgia.ten_tgia AS 'Tên tác giả',
    COUNT(baiviet.ma_bviet) AS 'Số bài viết'
FROM
    tacgia
LEFT JOIN baiviet ON tacgia.ma_tgia = baiviet.ma_tgia
GROUP BY
    tacgia.ten_tgia
ORDER BY
    COUNT(baiviet.ma_bviet) DESC
LIMIT 2;

SELECT *
FROM baiviet
WHERE ten_bhat LIKE '%yêu%'
   OR ten_bhat LIKE '%thương%'
   OR ten_bhat LIKE '%anh%'
   OR ten_bhat LIKE '%em%';
   
SELECT *
FROM baiviet
WHERE ten_bhat LIKE '%yêu%'
   OR ten_bhat LIKE '%thương%'
   OR ten_bhat LIKE '%anh%'
   OR ten_bhat LIKE '%em%';
   
CREATE VIEW vw_Music AS
SELECT
    baiviet.ma_bviet AS 'Mã bài viết',
    baiviet.tieude AS 'Tên bài viết',
    baiviet.ten_bhat AS 'Tên bài hát',
    theloai.ten_tloai AS 'Tên thể loại',
    tacgia.ten_tgia AS 'Tên tác giả',
    baiviet.ngayviet AS 'Ngày viết'
FROM
    baiviet
JOIN theloai ON baiviet.ma_tloai = theloai.ma_tloai
JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia;

DELIMITER //

CREATE PROCEDURE sp_DSBaiViet(IN p_ten_theloai VARCHAR(50))
BEGIN
    DECLARE v_theloai_id INT;

    -- Kiểm tra sự tồn tại của thể loại
    SELECT ma_tloai INTO v_theloai_id
    FROM theloai
    WHERE ten_tloai = p_ten_theloai;

    IF v_theloai_id IS NULL THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Thể loại không tồn tại';
    ELSE
        -- Trả về danh sách bài viết của thể loại
        SELECT
            baiviet.ma_bviet AS 'Mã bài viết',
            baiviet.tieude AS 'Tên bài viết',
            baiviet.ten_bhat AS 'Tên bài hát',
            tacgia.ten_tgia AS 'Tên tác giả',
            baiviet.ngayviet AS 'Ngày viết'
        FROM
            baiviet
        JOIN tacgia ON baiviet.ma_tgia = tacgia.ma_tgia
        WHERE
            baiviet.ma_tloai = v_theloai_id;
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER tg_CapNhatTheLoai
AFTER INSERT ON baiviet
FOR EACH ROW
BEGIN
    UPDATE theloai
    SET SLBaiViet = SLBaiViet + 1
    WHERE ma_tloai = NEW.ma_tloai;
END //

DELIMITER ;

CREATE TABLE Users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);