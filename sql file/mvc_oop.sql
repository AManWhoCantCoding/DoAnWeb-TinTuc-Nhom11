-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 03, 2025 lúc 05:10 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `mvc_oop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Thời sự', 'Tin tức thời sự, chính trị, xã hội trong nước và quốc tế', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(2, 'Thế giới', 'Các tin tức, sự kiện quốc tế nổi bật', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(3, 'Kinh doanh', 'Thông tin kinh tế, tài chính, doanh nghiệp và thị trường', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(4, 'Khoa học công nghệ', 'Tin tức, xu hướng, phát minh về khoa học và công nghệ', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(5, 'Góc nhìn', 'Bài viết bình luận, phân tích, ý kiến chuyên gia', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(6, 'Bất động sản', 'Tin tức về nhà đất, dự án, thị trường bất động sản', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(7, 'Sức khỏe', 'Kiến thức, lời khuyên về sức khỏe, y học và đời sống', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(8, 'Thể thao', 'Tin tức, kết quả, phân tích thể thao trong và ngoài nước', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(9, 'Giải trí', 'Tin tức showbiz, phim ảnh, âm nhạc và người nổi tiếng', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(10, 'Pháp luật', 'Thông tin, vụ án, chính sách, quy định pháp luật', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(11, 'Giáo dục', 'Tin tức về học tập, tuyển sinh, đổi mới giáo dục', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(12, 'Đời sống', 'Câu chuyện, phong cách sống, văn hóa, xã hội', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(13, 'Xe', 'Tin tức, đánh giá, thị trường xe hơi, xe máy', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(14, 'Du lịch', 'Điểm đến, kinh nghiệm, xu hướng du lịch trong và ngoài nước', '2025-10-23 22:08:09', '2025-10-23 15:08:09'),
(15, 'Khoa học', 'thay đổi', '2025-10-27 16:36:47', '2025-10-27 15:36:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_body` text NOT NULL,
  `parent` int(11) NOT NULL,
  `added_date` varchar(255) NOT NULL,
  `update_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment_body`, `parent`, `added_date`, `update_date`) VALUES
(88, 182, 128, 'HI', 0, 'October 24, 2025, 12:50 pm', '2025-10-24 09:50:15'),
(89, 182, 128, 'HI', 0, 'October 24, 2025, 12:50 pm', '2025-10-24 09:50:31');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `subject` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `contact`
--

INSERT INTO `contact` (`id`, `email`, `username`, `phone`, `subject`, `created_at`, `updated_at`) VALUES
(28, 'asdfasdf', 'sdfsdf', 35345, 'sdfsdf', '2023-05-03 00:00:00', '2023-04-30 23:54:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logo`
--

CREATE TABLE `logo` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `logo`
--

INSERT INTO `logo` (`id`, `title`, `img`, `created_at`, `updated_at`) VALUES
(9, 'main logo', 'IMG-670560600.jpg', '2025-10-23 00:00:00', '2025-10-23 15:01:42');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `our_media`
--

CREATE TABLE `our_media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `our_media`
--

INSERT INTO `our_media` (`id`, `name`, `url`, `created_at`, `updated_at`) VALUES
(8, 'facebook', 'https://www.facebook.com', '2025-10-23', '2025-10-23 14:58:42'),
(10, 'instagram', 'https://www.instagram.com/', '2025-10-23', '2025-10-23 15:00:57'),
(15, 'youtube', 'https://www.youtube.com/', '2025-10-23', '2025-10-23 14:59:55'),
(16, 'github', 'https://github.com/', '2025-10-23', '2025-10-23 15:00:11');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `tags` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `img`, `tags`, `category_id`, `author_id`, `created_at`, `updated_at`) VALUES
(181, 'Nút giao gần 3.000 tỷ đồng ở Cần Giờ sắp triển khai', 'Nút giao cao tốc Bến Lức - Long Thành và đường Rừng Sác, huyện Cần Giờ (cũ) dự kiến triển khai với tổng vốn gần 3.000 tỷ đồng, góp phần hoàn thiện hạ tầng ở khu vực.Thông tin được các chuyên gia nêu tại tọa đàm ngày 23/10, khi đề cập đến các tuyến giao thông kết nối khu vực Cần Giờ. Đây cũng là trục giao thông quan trọng cho dự án Khu đô thị lấn biển Vinhomes Green Paradise rộng 2.870 ha đang triển khai.Theo đó, dự án nút giao cao tốc Bến Lức - Long Thành và đường Rừng Sác đã được Sở Xây dựng trình UBND TP HCM xem xét hôm 7/10. Công trình thiết kế theo dạng liên thông khác mức, gồm các nhánh cầu vượt và hầm chui; mặt đất xây đảo tròn cho xe rẽ đi các hướng. Sơ bộ tổng mức đầu tư dự án khoảng 2.969 tỷ đồng, được đề xuất sử dụng từ ngân sách thành phố. Công trình dự kiến khởi công quý 2/2026, hoàn thành năm 2028.Cao tốc Bến Lức - Long Thành dài gần 58 km, kết nối Long An (hiện là Tây Ninh), TP HCM và Đồng Nai, theo kế hoạch sẽ hoàn thành năm 2026. Trong khi đó, đường Rừng Sác là trục giao thông &#34;xương sống&#34; ở Cần Giờ, kết nối từ bến phà Bình Khánh đến Khu đô thị Vinhomes Green Paradise. Nút giao kết nối hai tuyến này khi xây hoàn chỉnh kỳ vọng tạo thuận lợi cho người dân đi lại cũng như phát huy hiệu quả đầu tư các công trình. Đặc biệt, dự án cũng tạo thuận lợi cho đường hàng không, sân bay quốc tế Long Thành khi vào hoạt động sẽ kết nối nhanh chóng với Cần Giờ thông qua Quốc lộ 51 và cao tốc Bến Lức - Long Thành.Cùng với nút giao trên, kết nối giao thông đến Cần Giờ còn một loạt dự án khác cũng đang được xúc tiến triển khai. Trong đó, Vingroup cho biết tuyến tàu điện dài hơn 48 km, kết nối từ quận 7 (cũ) đến Cần Giờ do doanh nghiệp đề xuất đầu tư sẽ có tốc độ lên đến 350 km/h, giúp rút ngắn thời gian di chuyển của đoạn đường này chỉ còn 12 phút.Bên cạnh đó, Vingroup mới đây cũng đề xuất triển khai dự án đường vượt biển nối Cần Giờ đến Vũng Tàu, thời gian di chuyển ước tính chỉ 10 phút, góp phần tăng kết nối giao thông, phát triển kinh tế, du lịch TP HCM sau khi mở rộng địa giới hành chính.Dự án quan trọng khác là cầu Cần Giờ dài 7,3 km, vượt sông Soài Rạp, dự kiến khởi công năm 2026 với 6 làn xe, được kỳ vọng góp phần hoàn thiện hạ tầng giao thông cho khu vực Cần Giờ. Bên cạnh đó, Vingroup đang hoàn tất các thủ tục để tài trợ thêm 3 phà loại 200 tấn nhằm tăng khả năng vận chuyển giảm tải cho phà Bình Khánh, đồng thời triển khai tuyến tàu thủy cao tốc từ Bến Bạch Đằng đến Cần Giờ để tăng kết nối giao thông đến khu vực này.Cần Giờ cách trung tâm TP HCM khoảng 50 km, diện tích hơn 70.000 ha, trong đó 35.000 ha rừng ngập mặn phòng hộ. Tại đây đang triển khai dự án siêu đô thị biển Vinhomes Green Paradise lớn nhất TP HCM với mục tiêu thu hút 40 triệu khách mỗi năm. Tuy nhiên, khu vực kết nối với trung tâm chủ yếu qua phà Bình Khánh, thường xuyên quá tải.', 'IMG-131868806.jpg', 'Tin tức', 1, 127, '2025-10-23 17:19:42', '2025-10-23 15:19:42'),
(182, 'Nam Phi coi Việt Nam là người bạn thân thiết ở châu Á', 'Tổng thống Ramaphosa cho biết Việt Nam là &#34;người bạn thân thiết, đối tác quan trọng&#34; của Nam Phi ở châu Á, mong muốn phát triển quan hệ song phương.Tại cuộc hội đàm với Tổng thống Matamela Cyril Ramaphosa ở Phủ Chủ tịch hôm nay, Chủ tịch nước Lương Cường khẳng định Việt Nam và Nam Phi có quan hệ gắn bó lịch sử xuất phát từ lý tưởng chung vì độc lập, tự do và tinh thần đoàn kết Á - Phi, theo Bộ Ngoại giao.Việt Nam luôn coi trọng quan hệ hữu nghị truyền thống với Nam Phi, người bạn thân thiết, đối tác châu Phi đầu tiên Việt Nam xác lập khuôn khổ quan hệ Đối tác vì hợp tác và phát triển năm 2004.Tổng thống Ramaphosa chia sẻ Việt Nam là người bạn thân thiết, đối tác quan trọng của Nam Phi tại khu vực châu Á. Ông cho biết chuyến thăm cấp nhà nước nhằm khẳng định quyết tâm của Nam Phi trong củng cố, phát triển quan hệ đối tác với Việt Nam trong chiến lược tăng cường mở rộng thị trường, khi đang diễn ra nhiều chuyển đổi sâu sắc ở Nam Phi và thế giới.Tổng thống Nam Phi ủng hộ và đánh giá cao Việt Nam đăng cai tổ chức Lễ mở ký Công ước của Liên Hợp Quốc về chống tội phạm mạng, hoan nghênh vai trò dẫn dắt của Việt Nam trong nỗ lực chuyển đổi số. Ông khẳng định Nam Phi sẵn sàng ủng hộ ứng cử của Việt Nam tại các tổ chức của LHQ.Chủ tịch nước và Tổng thống Cyril Ramaphosa thống nhất định hướng và phấn đấu hoàn tất các thủ tục để sớm nâng cấp quan hệ Việt Nam - Nam Phi lên Đối tác chiến lược trong năm 2025, đưa quan hệ song phương đi vào chiều sâu, vì lợi ích của nhân dân hai nước và hòa bình, phát triển ở khu vực lẫn thế giới.Hai lãnh đạo nhất trí làm sâu sắc hơn sự gần gũi và tin cậy chính trị, thúc đẩy quan hệ hợp tác thương mại, đầu tư để tạo chuyển biến trong hợp tác kinh tế tương xứng với quy mô và nhu cầu thị trường, bảo đảm cân bằng lợi ích đôi bên.Hai bên nhất trí tiếp tục thúc đẩy hợp tác trong các lĩnh vực quan trọng và nhiều tiềm năng như quốc phòng, an ninh, năng lượng, khai khoáng, công nghiệp chế tạo, nông nghiệp, gìn giữ hòa bình, giáo dục, đào tạo nghề, hạ tầng, kinh tế xanh.Việt Nam và Nam Phi khẳng định tiếp tục phối hợp, hợp tác và ủng hộ lẫn nhau tại các diễn đàn đa phương và trên những vấn đề quốc tế, khu vực, nhất trí thúc đẩy giải quyết tranh chấp bằng biện pháp hòa bình, không sử dụng hoặc đe dọa sử dụng vũ lực trên cơ sở tôn trọng pháp luật quốc tế và Hiến chương LHQ.Thủ tướng Phạm Minh Chính cùng ngày hội kiến Tổng thống Nam Phi tại trụ sở chính phủ. Hai lãnh đạo nhất trí sớm hoàn tất thủ tục nội bộ để nâng cấp quan hệ lên Đối tác Chiến lược trong năm 2025, đưa quan hệ Việt Nam - Nam Phi trở thành kiểu mẫu của hợp tác giữa các nước phương Nam.Thủ tướng cho rằng hai nước có những thế mạnh có thể bổ sung cho nhau cùng phát triển, dư địa và tiềm năng thúc đẩy hợp tác còn rất lớn, tiếp tục mở rộng hợp tác sang các lĩnh vực chuyển đổi xanh, chuyển đổi số, kinh tế sáng tạo, năng lượng tái tạo, truyền thông, chống biến đổi khí hậu.Thủ tướng cho biết Việt Nam sẵn sàng tham gia và đóng góp tích cực cho thành công của Hội nghị Thượng đỉnh G20 năm 2025, đặc biệt trong các lĩnh vực ưu tiên chung như giảm đói nghèo và bất bình đẳng, bảo đảm an ninh lương thực, thúc đẩy phát triển bền vững, đẩy mạnh quá trình cải tổ hệ thống quản trị toàn cầu.Tổng thống Cyril Ramaphosa khẳng định Việt Nam là bạn bè gần gũi, thân thiết, đối tác tin cậy của Nam Phi tại khu vực châu Á. Ông mong muốn hai bên tăng cường kết nối doanh nghiệp trong lĩnh vực khai khoáng, công nghiệp chế tạo, nông nghiệp, xe ô tô điện, đào tạo nhân lực chất lượng cao, hàng hải.Hai bên xác định hợp tác kinh tế, thương mại, đầu tư là trọng tâm của quan hệ song phương thời gian tới, nhất trí thúc đẩy mở cửa thị trường cho hàng hóa và sản phẩm của mỗi bên, tích cực đàm phán, sớm ký kết thêm các văn kiện hợp tác nhằm tạo thuận lợi cho nâng cao kim ngạch thương mại, hợp tác đầu tư.', 'IMG-54540544.jpg', 'Tin tức', 2, 127, '2025-10-23 17:24:28', '2025-10-23 15:24:28'),
(183, 'Các hãng dầu quốc doanh Trung Quốc ngừng mua dầu Nga', 'Các hãng dầu quốc doanh lớn của Trung Quốc đã dừng mua dầu Nga bằng đường biển, do lo ngại các lệnh trừng phạt.Ngày 23/10, Reuters trích nguồn tin thân cận cho biết các công ty Trung Quốc gồm PetroChina, Sinopec, CNOOC và Zhenhua Oil sẽ dừng mua nhiên liệu từ Nga trong ngắn hạn. Động thái này được đưa ra sau khi Mỹ áp lệnh trừng phạt hai công ty dầu lớn nhất Nga là Rosneft và Lukoil ngày 22/10.Các hãng lọc dầu Ấn Độ - khách mua dầu Nga nhiều nhất bằng đường biển, cũng được dự báo giảm mạnh nhập nhiên liệu này từ Moskva. Việc này nhằm tuân thủ các lệnh trừng phạt của Mỹ liên quan đến chiến sự Nga - Ukraine.Giới phân tích cho rằng nếu nhu cầu của hai khách hàng lớn nhất sụt giảm, nguồn thu từ dầu mỏ của Nga sẽ đi xuống. Việc này cũng buộc Trung Quốc và Ấn Độ - các nước mua dầu hàng đầu thế giới - tìm nguồn cung thay thế từ Trung Đông, châu Phi hoặc Mỹ Latin, từ đó đẩy giá toàn cầu lên cao.Trước khi Mỹ công bố lệnh trừng phạt, giá dầu ESPO (Nga) giao tháng 11 chỉ cao hơn dầu Brent 1 USD. Hồi đầu tháng 10, mức chênh là 1,7 USD.Trung Quốc hiện nhập khẩu 1,4 triệu thùng dầu Nga mỗi ngày bằng đường biển. Phần lớn cho các nhà máy lọc dầu tư nhân nhỏ.Trong khi đó, Vortexa Analytics cho biết các hãng dầu quốc doanh Trung Quốc mua khoảng 250.000 thùng một ngày trong 9 tháng đầu năm. Ước tính của Energy Aspects là 500.000 thùng.Nguồn tin khác cho biết Unipec - mảng kinh doanh của Sinopec đã dừng mua nhiên liệu của Nga từ tuần trước, sau khi Anh trừng phạt Rosneft và Lukoil, đội tàu bóng tối chuyên chở dầu Nga và các thực thể khác từ Trung Quốc.Rosneft và Lukoil bán phần lớn dầu cho Trung Quốc thông qua các công ty trung gian, thay vì giao dịch trực tiếp. Dù vậy, một số thương nhân cho biết các nhà máy lọc dầu tư nhân vẫn muốn tiếp tục mua dầu Nga.Tuy nhiên, ngoài đường biển, Trung Quốc còn nhập khoảng 900.000 thùng dầu Nga qua đường ống, toàn bộ của PetroChina. Giới buôn dầu cho rằng hoạt động này sẽ ít chịu ảnh hưởng từ các lệnh trừng phạt.&nbsp;', 'IMG-1239584635.jpg', 'Tin tức', 3, 127, '2025-10-23 17:22:39', '2025-10-23 15:22:39'),
(184, 'xin chao', 'xin chao', 'IMG-868286593.png', 'Tin tức', 1, 128, '2025-10-24 11:47:05', '2025-10-24 09:47:05');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetId` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `content`, `img`, `created_at`, `updated_at`) VALUES
(17, 'Tin tức', 'Cập nhật liên tục', 'IMG-836367079.jpg', '', ''),
(18, 'Thông tin', 'Đa dạng, nhanh chóng', 'IMG-1372144661.jpg', '', ''),
(19, 'Chủ đề ', 'Xoay quanh cuộc sống, mọi lĩnh vực, ngành nghề', 'IMG-1372144663.jpg', '', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL,
  `country` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `group_id` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 for normal users,\r\n1 for admins',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`, `profile_img`, `gender`, `country`, `status`, `group_id`, `created_at`, `updated_at`) VALUES
(115, 'hxl', 'hxl@gmail.com', '$2y$10$zdFe9fMHoq90hG2JSOhItOV1Mz0S2Yv7IVlHkdAuM8FbG0ZD5y3Im', 'IMG-81826267.png', 0, 'VN', 1, 1, '2025-10-23 21:40:16', '2025-10-27 16:54:04'),
(119, 'user', 'user@gmail.com', '$2y$10$qvQID0Ooo8Oonx6LKq4bweq1XfLsRptqzDeKQgQvv9emAbs3bIlva', '', 0, 'VN', 1, 0, '2025-10-23 03:34:28', '0000-00-00 00:00:00'),
(124, 'user11', 'user1@gmail.com', '$2y$10$mlYzwHyW09YntMYlZKZOZemmIQ..raVijPuvPeIy4NUrmTtyYQmka', '', 0, 'VN', 1, 0, '2025-10-23 05:32:20', '2025-11-01 19:44:03'),
(125, 'user2', 'user2@gmail.com', '$2y$10$ZW4vlZZCN06s8patrYsrJOMZBfYWXUb980U6nEL.HqhJoOVqk26w.', 'asdf', 0, 'VN', 0, 0, '2025-10-23 05:32:28', '2025-10-23 05:32:28'),
(126, 'user3', 'user3@gmail.com', '$2y$10$GkTQrED0y0Gt1m0wX/yt3.oSBEiOTXsrpkGXerFN62NvOonqW004W', '', 0, 'VN', 0, 0, '2025-10-23 21:48:16', '2025-10-23 21:48:16'),
(127, 'admin1', 'admin1@gmail.com', '$2y$10$mv.nBDDO43GknxjXtP9P.ujmPvwU5S/lxIZdHgOMh24OKAncP6GAe', 'IMG-81826268.png', 0, 'VN', 0, 1, '2025-10-23 21:48:55', '0000-00-00 00:00:00'),
(128, 'abc', 'abc@gmail.com', '$2y$10$3xiniLnUMM/V3rr1oivjsugxrT.VX4eQFMLRAw2UIy/7xB6Ld7qCW', 'C:/xampp/htdocs/Blog-with-mvc-system-master/admin/public/img/post/88441703IMG-81826267.png', 0, 'VN', 1, 0, '2025-10-24 11:41:25', '2025-10-24 11:46:08');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Chỉ mục cho bảng `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logo`
--
ALTER TABLE `logo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `our_media`
--
ALTER TABLE `our_media`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetId`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT cho bảng `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `logo`
--
ALTER TABLE `logo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `our_media`
--
ALTER TABLE `our_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT cho bảng `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
