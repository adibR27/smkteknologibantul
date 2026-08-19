-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 29, 2026 at 03:56 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smkteknologibantul`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `email`, `created_at`, `updated_at`) VALUES
(1, 'adib', '$2y$12$5Ny.3djktvqSjwMMLgd9uenOgp0Bz5Wz4GaV30hlf/8rDzfYWUaYq', 'Adib Rahmadi', 'adib@smkteknologibantul.sch.id', '2025-12-15 04:21:03', '2026-01-14 17:02:20'),
(2, 'kamidi', '$2y$12$oCOSIPPjkKO6emuBX9xqXOMUYV/.EKiysCH22bBfHrnW5WpIt3Z0a', 'kamidi', 'kamidi@gmail.com', '2026-01-14 17:28:27', '2026-01-14 17:28:27'),
(4, 'admin', '$2y$12$WzpLn0HqfV3A2LFsT6lAvug6b23tNMnV/moDCRALBVg5sdEjg9q7S', 'Super Admin', 'admin@gmail.com', '2026-05-15 08:05:13', '2026-05-15 08:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

CREATE TABLE `alumni` (
  `id` bigint UNSIGNED NOT NULL,
  `pesan_alumni` text COLLATE utf8mb4_unicode_ci,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan_id` bigint UNSIGNED DEFAULT NULL,
  `tahun_lulus` year NOT NULL,
  `pekerjaan_sekarang` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`id`, `pesan_alumni`, `nama_lengkap`, `foto`, `jurusan_id`, `tahun_lulus`, `pekerjaan_sekarang`, `created_at`, `updated_at`) VALUES
(1, 'SMK Teknologi Bantul bukan hanya tempat saya belajar keterampilan, tetapi juga membentuk karakter dan mental kerja saya. Ilmu dan pengalaman yang saya dapatkan menjadi bekal berharga untuk bersaing di dunia kerja dan melanjutkan pendidikan ke jenjang yang lebih tinggi.', 'kamidi', 'alumni/LG71imvZJ41E3z07cnbwqBBjIwCrTyzGRK2ZXhiV.png', 1, '2026', 'PT. Yamaha', '2026-01-08 09:51:12', '2026-01-08 09:51:12'),
(2, 'Manfaatkan waktu belajar kalian di SMK Teknologi Bantul sebaik mungkin. Jangan ragu untuk bertanya, berlatih, dan mencoba hal baru. Apa yang kalian pelajari hari ini akan sangat berguna di masa depan', 'Sulastri', 'alumni/V6Ok7hqhmX3JWAyUgG9RmtjWHBokL2J2zDYI5eew.png', 3, '2017', 'PT. DOOM', '2026-01-08 09:52:17', '2026-01-08 09:54:19'),
(3, 'Berkat pembelajaran praktik dan bimbingan guru di SMK Teknologi Bantul, saya lebih siap menghadapi dunia industri. Disiplin, tanggung jawab, dan keterampilan yang diajarkan sangat terasa manfaatnya saat saya sudah bekerja', 'Budi', 'alumni/xB6X9HCrB9ciPgeH0YDEeDt30eyi5SqBFkpPcwqr.png', 2, '2019', 'PT. Telkom', '2026-01-08 09:53:09', '2026-01-08 09:53:09'),
(4, 'Saya bangga menjadi bagian dari alumni SMK Teknologi Bantul. Sekolah ini telah memberi saya dasar keahlian, kepercayaan diri, dan semangat untuk terus berkembang serta berkontribusi di masyarakat.', 'Putri Ayu', 'alumni/DrZTP2wl136JAAOPOlgFvo2DRFgbjmAoecJaWdc3.png', 1, '2026', 'PT. Honda', '2026-01-08 09:54:04', '2026-01-08 09:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gambar_utama` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kategori` enum('berita','pengumuman','kegiatan','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'berita',
  `penulis_id` bigint UNSIGNED DEFAULT NULL,
  `views` int NOT NULL DEFAULT '0',
  `tanggal_publish` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`id`, `judul`, `slug`, `konten`, `gambar_utama`, `kategori`, `penulis_id`, `views`, `tanggal_publish`, `created_at`, `updated_at`) VALUES
(2, 'The study aimed to evaluate the usability of the A', 'the-study-aimed-to-evaluate-the-usability-of-the-a', '<p><strong>II. EASE OF USE</strong><br><strong>A. Overview of UX Evaluation Methods</strong><br><strong>User experience (UX) evaluation plays a critical role in determining the success and adoption of mobile health (mHealth) applications. Two widely accepted tools for this purpose are the System Usability Scale (SUS) and the User Experience Questionnaire (UEQ). SUS offers a quick and reliable assessment of perceived usability using a 10-item Likert scale, while UEQ</strong> <em>captures broader experiential dimensions such as attractiveness, efficiency, dependability, and stimulation. In this section, we review and compare seven empirical studies that utilized ei</em>t<span style=\"text-decoration:underline;\">her or both tools to assess ease of use in different mobile applications across various health domains, including rehabilitation, chronic disease management, pediatric oncology, and adolescent nutrition tracking.</span></p>\r\n<p>B. Studies Utilizing Both SUS and UEQ<br>Five of the reviewed studies employed both SUS and UEQ, allowing for a comparative and complementary analysis of usability and overall user experience</p>\r\n<p> </p>\r\n<p style=\"text-align:center;\"><span style=\"color:#e03e2d;\">The AIMS platform, designed to support. rehabilitation after orthopedic surgery, received high usability ratings. The clinical portal scored 82.88 on SUS, and the patient-facing app scored 74.41. UEQ scores reinforced these findings, with positive ratings across attractiveness, clarity, and efficiency.</span><br><span style=\"color:#e03e2d;\">Similarly, AphasiaGo, a location-based serious ga</span><span style=\"background-color:#3598db;\">me developed for aphasia rehabilitation, yielded a SUS score of 75.2 and UEQ scores placing it among the top 10% of evaluated products. Its co-design approach with speech therapists likely contributed to the high satisfaction outcomes.</span><br><span style=\"background-color:#3598db;\">Another strong example was a suite of mobile apps for self-administered physical function tests for seniors. These apps underwent three iterations of usability testing, culminating in a SUS score of 77.63 and highly favorable UEQ feedback in terms of ease of use, clarity, and user confidence.</span><br>In a comparative study of digital forms used in healthcare, the single-page form outperformed both multipage and chatbot versions. It recorded a SUS score of 76, the shortest task completion time, and the most positive UEQ results.<br>The Flexig app for managing subcutaneous immunoglobulin therapy among chronic disease patients not only scored 76.2 on SUS but also demonstrated a direct link between user satisfaction and treatment adherence (99.7%), illustrating the functional impact of good usability.</p>\r\n<p style=\"text-align:right;\">C. Studies Utilizing a Single Tool (SUS or UEQ)<br>Two studies used only one of the evaluation tools, providing useful but slightly narrower insights.<br>The CanSelfMan app for children with cancer and their caregivers employed only the UEQ to evaluate usability. Participants reported high scores in efficiency, perspicuity, and attractiveness, but relatively low ratings in novelty. While the UEQ gave a broader view of emotional and experiential design aspects, the absence of SUS prevented detailed benchmarking of usability in comparison with other systems.<br>In contrast, the meal-monitoring app for adolescents relied solely on SUS, achieving a score of 77.1. Users appreciated the system’s simplicity and were comfortable using it primarily at home. However, the lack of UEQ results meant that emotional and aesthetic dimensions of experience could not be evaluated.</p>\r\n<p style=\"text-align:justify;\">D. Comparative Summary of Usability Results<br>Across all seven studies, SUS scores ranged from 74.1 to 82.9, consistently surpassing the industry-standard threshold of 68, indicating above-average usability. The highest SUS score was observed in the AIMS clinical portal (82.88), followed by the digital form (76), and Flexig (76.2). On the UEQ side, multiple applications ranked highly in attractiveness, efficiency, and clarity, particularly AphasiaGo and Flexig. However, novelty tended to be the lowest-scoring UEQ dimension in most cases, suggesting a general trend of conservative design choices in mHealth applications. Importantly, studies that implemented both SUS and UEQ were better able to capture usability holistically, showing not only how easy the apps were to use, but also how they were experienced emotionally and cognitively by users.</p>\r\n<ul>\r\n<li>E. Limitations in Reviewed Studies<br>Despite positive r</li>\r\n<li>esults, several limitations were shared across the studies. First, sample sizes were often limited, ranging from as few as 21 participants to just over 240, which can affect statistical power and generalizability. Second, many of the participants were from specific demographic groups (e.g., adolescents, cancer patients, older adults), and very few studies explored differences in usabilit</li>\r\n<li>y across gender, age, or digital literacy levels. Third, most studies lacked a control group or baseline comparison, making it difficult to evaluate the relative improvement provided by the tested app. Lastly, self-reported measures—although useful—introduce bias and should ideally be supplemented by objective behavioral data.</li>\r\n</ul>\r\n<p><a title=\"faceboook\" href=\"https://www.facebook.com/share/1CN8LLHF69/\" target=\"_blank\" rel=\"noreferrer noopener\">faceboook orang tampan</a></p>\r\n<p><img src=\"../../../storage/artikel/images/nxFVNHbvvoeTyvlSb0VAMN0Tg8N70kDNIUgi19dT.jpg\" alt=\"\" width=\"440\" height=\"234\"></p>\r\n<p><iframe src=\"https://www.youtube.com/embed/4kEiMn9jbRA?si=0oS9os5pQz9ApvUB\" width=\"560\" height=\"315\" allowfullscreen></iframe></p>\r\n<p> </p>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>sad</td>\r\n<td>fasfdx</td>\r\n<td>wegtfwsa</td>\r\n<td>yhwrey</td>\r\n</tr>\r\n<tr>\r\n<td>yearsdf</td>\r\n<td>erygse</td>\r\n<td>yawerd</td>\r\n<td>yraeg</td>\r\n</tr>\r\n<tr>\r\n<td>refyt</td>\r\n<td>rhyes</td>\r\n<td>hgdsfxc</td>\r\n<td>REH</td>\r\n</tr>\r\n<tr>\r\n<td>erszdtf</td>\r\n<td>greszdg</td>\r\n<td>regd</td>\r\n<td>hre</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<ol>\r\n<li>F. Implications for Future Research</li>\r\n<li><br>These findings reinforce the importance of combining both SUS and UEQ for a comprehensive evaluation of mHealth applications. Future research should ad</li>\r\n<li>opt mixed-methods designs, expand sample diversity, and integrate objective analytics such as task error rates, usage logs, and time-on-task. Furthermore, integrating newer frameworks such as the mHealth App Usability Questionnaire (MAUQ) or SUPR-Q may provide addition</li>\r\n<li>al depth. Ultimately, optimizing ease of use is not just a matter of user interface design but also of ensuring clinical impact and long-term adoption.</li>\r\n</ol>\r\n<p>yang kamu tulis diatas menggunakan 7 jurnal yang saya kirim tadi kan? kamu tidak mengarang bebas kan?<br>maaf bukannya meragukanmu tapi saya butuh validasi.</p>', 'artikel/15LF6ye1yc2stu82tl53nlsabydvcPreQGDRSW5z.png', 'berita', 1, 9, '2025-12-24 00:02:00', '2025-12-23 17:03:11', '2026-01-05 10:44:05'),
(4, 'Initialize TinyMCE dengan AUTO CONVERT YouTube URL', 'initialize-tinymce-dengan-auto-convert-youtube-url', '<p>// Initialize TinyMCE dengan AUTO CONVERT YouTube URL<br>tinymce.init({<br>    selector: \'#konten\',<br>    height: 500,<br>    menubar: false,<br>    plugins: [<br>        \'advlist\', \'autolink\', \'lists\', \'link\', \'image\', \'charmap\', \'preview\',<br>        \'anchor\', \'searchreplace\', \'visualblocks\', \'code\', \'fullscreen\',<br>        \'insertdatetime\', \'media\', \'table\', \'help\', \'wordcount\'<br>    ],<br>    toolbar: \'undo redo | blocks | \' +<br>        \'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter \' +<br>        \'alignright alignjustify | bullist numlist outdent indent | \' +<br>        \'link image media table | removeformat code fullscreen help\',<br>    content_style: \'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }\',<br>    <br>    // ✅ INI YANG BIKIN AUTO CONVERT<br>    media_live_embeds: true,<br>   <iframe src=\"https://www.youtube.com/embed/n_PlDgCl83Q?si=NNLTRfotNUTptX6S\" width=\"560\" height=\"315\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe> <br>    // ✅ TAMBAHKAN INI - Auto convert YouTube URL<br>    media_url_resolver: function (data, resolve, reject) {<br>        try {<br>            let videoId = \'\';<br>            const url = data.url;<br>            <br>            // Extract video ID dari berbagai format<br>            if (url.includes(\'youtu.be/\')) {<br>                // Format: https://youtu.be/4kEiMn9jbRA atau https://youtu.be/4kEiMn9jbRA?si=xxx<br>                videoId = url.split(\'youtu.be/\')[1].split(\'?\')[0].split(\'&amp;\')[0].split(\'/\')[0];<br>            } else if (url.includes(\'youtube.com/watch\')) {<br>                // Format: https://www.youtube.com/watch?v=4kEiMn9jbRA<br>                const params = new URLSearchParams(url.split(\'?\')[1]);<br>                videoId = params.get(\'v\');<br>            } else if (url.includes(\'youtube.com/embed/\')) {<br>                // Format: https://www.youtube.com/embed/4kEiMn9jbRA<br>                videoId = url.split(\'embed/\')[1].split(\'?\')[0].split(\'&amp;\')[0];<br>            }<br>            <br>            if (videoId) {<br>                // Return embed code<br>                resolve({<br>                    html: \'&lt;iframe width=\"560\" height=\"315\" src=\"https://www.youtube.com/embed/\' + videoId + <br>                          \'\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen&gt;&lt;/iframe&gt;\'<br>                });<br>            } else {<br>                // Bukan YouTube URL, biarkan TinyMCE handle default<br>                resolve({html: \'\'});<br>            }<br>        } catch (error) {<br>            console.error(\'Error parsing YouTube URL:\', error);<br>            reject(\'Invalid YouTube URL\');<br>        }<br>    },</p>\r\n<p>    // Konfigurasi Upload Gambar<br>    images_upload_handler: function(blobInfo, progress) {<br>        return new Promise((resolve, reject) =&gt; {<br>            const formData = new FormData();<br>            formData.append(\'file\', blobInfo.blob(), blobInfo.filename());</p>\r\n<p>            fetch(\'/admin/upload-image\', {<br>                    method: \'POST\',<br>                    body: formData,<br>                    headers: {<br>                        \'X-CSRF-TOKEN\': document.querySelector(\'meta[name=\"csrf-token\"]\').content<br>                    }<br>                })<br>                .then(response =&gt; response.json())<br>                .then(data =&gt; {<br>                    if (data.location) {<br>                        resolve(data.location);<br>                    } else {<br>                        reject(\'Upload gagal\');<br>                    }<br>                })<br>                .catch(() =&gt; {<br>                    reject(\'Upload gagal\');<br>                });<br>        });<br>    }<br>});</p>\r\n<p>// Validasi form sebelum submit<br>document.getElementById(\'artikelForm\').addEventListener(\'submit\', function(e) {<br>    tinymce.triggerSave();<br>    const konten = tinymce.get(\'konten\').getContent();<br>    <br>    if (!konten || konten.trim() === \'\') {<br>        e.preventDefault();<br>        document.getElementById(\'konten-error\').style.display = \'block\';<br>        tinymce.get(\'konten\').focus();<br>        alert(\'Konten artikel wajib diisi!\');<br>        return false;<br>    }<br>    <br>    document.getElementById(\'konten-error\').style.display = \'none\';<br>});</p>', 'artikel/71bLTtcOjCWgShmxYkFUUb3oUAaLMSCrvjYYYRJe.png', 'kegiatan', 1, 4, '2025-12-24 01:21:00', '2025-12-23 18:22:28', '2026-01-05 10:43:17'),
(5, 'Intisari merupakan outline dari sebuah hasil penelitian/karya ilmiah/naskah/proyek', 'intisari-merupakan-outline-dari-sebuah-hasil-penelitiankarya-ilmiahnaskahproyek', '<p> </p>\r\n<p>Intisari merupakan outline dari sebuah hasil penelitian/karya ilmiah/naskah/proyek resmi yang memerlukan deskripsi secara singkat. Intisari disusun dengan kalimat yang singkat, jelas, runtut, dan sistematis dan dapat menggambarkan isi laporan secara keseluruhan. Intisari disusun dalam bahasa Indonesia, disusun menjadi 1 alinea, tidak lebih dari 1 halaman, berkisar antara 150-250 kata, diketik dengan jarak 1 spasi. <br>Intisari Skripsi memuat masalah apa yang terjadi dan dampak dari masalah terhadap lingkungan. Metode apa yang dilakukan peneliti dalam menyelesaikan masalah? Bagaimana hasil akhir penelitian, dan siapa yang dapat memanfaatkan hasil penelitian ini. Jika disajikan dalam 3 Alinea (paragraph), maka alinea pertama dalam intisari berisi masalah penelitian dan dampak dari masalah tersebut. Alinea kedua berisi metode penelitian (langkah-langkah penyelesaian masalah). Alinea ketiga mengungkapkan hasil dari penelitian (secara singkat), kontribusi penelitian, dan siapa yang dapat memanfaatkan hasil penelitian tersebut. Jika belum mencapai 250 kata, dapat ditambahkan penelitian lebih lanjut yang dapat direkomendasikan.<br>Di bagian bawah intisari dituliskan kata-kata kunci, bisa berupa kata-kata penting dalam intisari atau kata yang sering muncul, berjumlah maksimal 5 (lima) kata.</p>\r\n<p>Kata kunci: satu, dua, tiga, empat, lima</p>\r\n<p> </p>\r\n<p><iframe src=\"https://www.youtube.com/embed/tgGxUCWliNs?si=PEmD_H4ei7rpw8NR\" width=\"560\" height=\"315\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share\" allowfullscreen></iframe></p>\r\n<p>abtract yang sudah aku buat: </p>\r\n<p>Perkembangan teknologi informasi menuntut sekolah untuk menyediakan akses informasi yang cepat, akurat, dan mudah diakses oleh siswa, guru, orang tua, serta masyarakat. Namun, SMK Teknologi Bantul belum memiliki website informasi yang mampu menampilkan profil sekolah, program keahlian, berita, dan layanan akademik secara terintegrasi. Kondisi tersebut berdampak pada rendahnya keterjangkauan informasi sekolah dan kurang efektifnya proses penyampaian informasi kepada publik. Oleh karena itu, diperlukan pembangunan website informasi yang dapat menjadi media komunikasi resmi dan meningkatkan transparansi informasi sekolah. Penelitian ini menggunakan metode Design and Development dengan pendekatan Human-Computer Interaction (HCI). Proses penelitian meliputi analisis kebutuhan pengguna, perancangan antarmuka menggunakan prinsip user-centered design, pengembangan website berbasis web, serta evaluasi kegunaan menggunakan uji usability. Pengumpulan data dilakukan melalui wawancara, observasi, dan studi dokumentasi untuk memperoleh kebutuhan informasi sekolah secara tepat dan mendalam. Hasil penelitian menunjukkan bahwa website yang dikembangkan mampu memfasilitasi penyampaian informasi sekolah secara lebih efektif, terstruktur, dan mudah digunakan oleh pengguna. Evaluasi usability menunjukkan tingkat kemudahan penggunaan yang baik dan penerimaan positif dari pengguna. Website ini dapat dimanfaatkan oleh pihak sekolah, siswa, dan masyarakat luas sebagai sumber informasi resmi. Penelitian selanjutnya direkomendasikan untuk mengintegrasikan fitur layanan akademik digital dan sistem manajemen konten yang lebih adaptif. *Kata Kunci:* website informasi, perancangan sistem, HCI, usability, sekolah.</p>', 'artikel/73pEZEQPHUzlOADPVmi6hxDSP2EisIcAY4dhMIvN.jpg', 'lainnya', 1, 8, '2025-12-24 01:29:00', '2025-12-23 18:33:31', '2026-06-02 10:55:14'),
(6, 'VJGym', 'vjgym', '<p>dddddddddddddddddddddddddddd</p>', 'artikel/WoAgWbG8aLLoBWYXdEpbn06Ljazddnyrs8ProtM8.png', 'kegiatan', 1, 1, '2026-01-07 15:23:00', '2026-01-07 08:24:20', '2026-05-15 09:24:01');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `id` bigint UNSIGNED NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`id`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'TEKNOBA', 'carousel/bSVqzlYdZs3m2CFOqihoEWLxZnTk7ohRm7vBUKqM.jpg', '2025-12-19 02:39:39', '2026-06-02 09:11:37'),
(2, 'lklkl', 'carousel/kJ3GtPkDOIqYhje6NABhEZtBcfJlwQ0rZ6KSivgg.jpg', '2025-12-19 02:41:24', '2025-12-19 04:25:23'),
(3, 'Deskripsi yang akan ditampilkan pada carousel', 'carousel/1ZxLtan1QzAuaMS0oEx09tgWH0yeIehxgP21anGY.jpg', '2025-12-19 02:41:44', '2025-12-19 04:35:44'),
(4, NULL, 'carousel/IGISBGCBorMHl90mvgpM1EYn9kxunso02uMG0suW.jpg', '2025-12-19 02:42:05', '2025-12-19 02:42:05'),
(5, NULL, 'carousel/FDNDXZwBdBFwrJsRBARsScQG4M3daCjllFqofiJe.png', '2025-12-19 04:26:07', '2025-12-19 04:26:07');

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `nama_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ukuran_file` int DEFAULT NULL,
  `kategori` enum('kurikulum','panduan','jadwal','lainnya') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'lainnya',
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `judul`, `deskripsi`, `nama_file`, `path_file`, `ukuran_file`, `kategori`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(1, 'Implementasi User Interface User Experience', 'Implementasi UIUX', '1766741134_Star Property_Implementasi UIUX SI.pdf', 'dokumen/1766741134_Star Property_Implementasi UIUX SI.pdf', 4242527, 'jadwal', 1, '2025-12-26 09:25:34', '2025-12-26 09:25:34'),
(2, 'Evaluasi User Interface User Experience', 'Evaluasi UIUX', '1766741178_Evaluasi User Experience Website StarProperty .xlsx', 'dokumen/1766741178_Evaluasi User Experience Website StarProperty .xlsx', 14985, 'panduan', 1, '2025-12-26 09:26:18', '2025-12-26 09:26:18'),
(3, 'Interaksi Manusia Komputer', 'IMK', '1766741281_UAS HCI 2025.docx', 'dokumen/1766741281_UAS HCI 2025.docx', 4985417, 'lainnya', 1, '2025-12-26 09:28:01', '2025-12-26 09:28:01'),
(4, 'Comparing Single-Page, Multipage, and Conversational Digital', 'Jurnal UIUX semester 6', '1766741396_Comparing Single-Page, Multipage, and Conversational Digital.pdf', 'dokumen/1766741396_Comparing Single-Page, Multipage, and Conversational Digital.pdf', 1334965, 'kurikulum', 1, '2025-12-26 09:28:57', '2025-12-26 09:29:56'),
(5, 'UX_Evaluation_SUS_UEQ_Presentation.pptx', 'UX_Evaluation_SUS_UEQ_Presentation.pptx', '1766744528_UX_Evaluation_SUS_UEQ_Presentation.pptx', 'dokumen/1766744528_UX_Evaluation_SUS_UEQ_Presentation.pptx', 34828, 'panduan', 1, '2025-12-26 10:22:08', '2025-12-26 10:22:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` bigint UNSIGNED NOT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kegiatan` date DEFAULT NULL,
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `caption`, `gambar`, `tanggal_kegiatan`, `uploaded_by`, `created_at`, `updated_at`) VALUES
(2, '4444444444ttteeeeeeeee', 'galeri/1766749977_694e7719ec644.jpeg', '2025-12-26', 1, '2025-12-26 11:52:57', '2025-12-26 11:52:57'),
(3, 'asdaedwe', 'galeri/1766751098_694e7b7aa5ae2.jpeg', '2025-12-26', 1, '2025-12-26 12:11:38', '2025-12-26 12:11:38'),
(4, 'ewrdwesafwf', 'galeri/1766751118_694e7b8ed8ce6.jpeg', NULL, 1, '2025-12-26 12:11:58', '2025-12-26 12:11:58'),
(5, 'gtryhrdr', 'galeri/1766751139_694e7ba3e7569.jpeg', NULL, 1, '2025-12-26 12:12:19', '2025-12-26 12:12:19'),
(6, 'sdfwrt', 'galeri/1766751162_694e7bbaaab25.jpeg', NULL, 1, '2025-12-26 12:12:42', '2025-12-26 12:12:42');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_lengkap` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jurusan_id` bigint UNSIGNED DEFAULT NULL,
  `jabatan` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mata_pelajaran` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`id`, `nama_lengkap`, `foto`, `email`, `jurusan_id`, `jabatan`, `mata_pelajaran`, `pendidikan_terakhir`, `created_at`, `updated_at`) VALUES
(2, 'Budi S.Pd', 'guru/xhSB4WBqkcZAIP7p1UERHOPrU3DBrqdtvrk5eDZt.png', 'budi@gmail.com', 2, 'Wali Kelas', 'Bahasa Inggris', 'S1 Pendidikan Bahasa inggris', '2026-01-07 08:59:25', '2026-01-07 08:59:25'),
(3, 'kamidi', 'guru/BTs8YKnheAkUBoDQOeilXKld89ShFuB33lMTCLvf.jpg', 'kamidi@gmail.com', 2, 'Tenaga Pendidik', 'Olahraga', 'S1 Pendidikan Olahraga', '2026-01-07 09:00:35', '2026-01-07 10:53:21'),
(4, 'kamidi S.Pd.', 'guru/oRwjkbekXywqZnxjijQmQuPpCjxFJrz3PjcSsQhm.jpg', 'kamidi@gmail.com', 2, 'Tenaga Pendidik', 'Mikrotik', 'S1 Pendidikan Komputer & Jaringan', '2026-01-07 09:02:17', '2026-01-07 09:02:17'),
(5, 'Sulastri S.Pd.', 'guru/4XWFS6eKyF4xNcNYBAShIaPhOV2PSq4gfOlzRt06.png', 'kamidi@gmail.com', 3, 'Tenaga Pendidik', 'Desain', 'S1 Pendidikan Tata Busana', '2026-01-07 09:03:13', '2026-01-07 09:03:13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE `jurusan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_jurusan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fasilitas_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama_jurusan`, `fasilitas_jurusan`, `deskripsi`, `gambar`, `created_at`, `updated_at`) VALUES
(1, 'Jurusan Teknik Bodi Otomotif', 'Bengkel Bodi Otomotif, Ruang Las, Ruang Pengecatan, Ruang Perbaikan Panel Bodi', '<p data-start=\"238\" data-end=\"642\">Jurusan <strong data-start=\"246\" data-end=\"270\">Teknik Bodi Otomotif</strong> merupakan program keahlian yang membekali peserta didik dengan pengetahuan, keterampilan, dan sikap profesional dalam bidang perbaikan dan perawatan bodi kendaraan bermotor. Kompetensi yang dipelajari mencakup perbaikan panel bodi, pengelasan bodi kendaraan, pengecatan (refinishing), serta penerapan keselamatan dan kesehatan kerja (K3) sesuai standar industri otomotif.</p>\r\n<p data-start=\"644\" data-end=\"1001\">Peserta didik dilatih untuk mampu melakukan analisis kerusakan bodi kendaraan, menggunakan berbagai peralatan dan teknologi bengkel bodi otomotif, serta menerapkan prosedur kerja yang tepat dan aman. Proses pembelajaran dilaksanakan melalui kegiatan teori dan praktik secara terintegrasi di bengkel praktik yang dilengkapi dengan peralatan standar industri.</p>\r\n<p data-start=\"1003\" data-end=\"1471\">Selain penguasaan keterampilan teknis, jurusan ini juga menanamkan sikap kerja disiplin, tanggung jawab, ketelitian, dan kemampuan bekerja secara mandiri maupun dalam tim. Lulusan Jurusan Teknik Bodi Otomotif diharapkan memiliki kompetensi yang siap kerja dan mampu bersaing di dunia usaha dan dunia industri, khususnya pada bidang perbaikan bodi kendaraan, bengkel pengecatan, industri karoseri, serta memiliki peluang untuk berwirausaha di bidang jasa bodi otomotif.</p>', 'jurusan/1767602700_jurusan-teknik-bodi-otomotif.jpeg', '2026-01-05 08:45:01', '2026-01-05 08:45:01'),
(2, 'Jurusan Teknik Jaringan Akses', 'Laboratorium Jaringan Akses, Perangkat Jaringan, Peralatan Fiber Optik, Peralatan Jaringan Tembaga', '<p data-start=\"1319\" data-end=\"1694\">Jurusan <strong data-start=\"1327\" data-end=\"1352\">Teknik Jaringan Akses</strong> merupakan program keahlian yang membekali peserta didik dengan kompetensi dalam perancangan, instalasi, pengoperasian, dan pemeliharaan jaringan akses telekomunikasi. Fokus pembelajaran meliputi jaringan berbasis tembaga, serat optik (fiber optik), serta jaringan nirkabel yang digunakan untuk layanan komunikasi data, suara, dan multimedia.</p>\r\n<p data-start=\"1696\" data-end=\"2150\">Peserta didik dilatih untuk memahami konsep dasar jaringan akses, melakukan instalasi dan konfigurasi perangkat jaringan, pengukuran dan pengujian kualitas jaringan, serta penanganan gangguan sesuai dengan standar operasional prosedur (SOP) dan prinsip keselamatan dan kesehatan kerja (K3). Kegiatan pembelajaran dilaksanakan melalui perpaduan teori dan praktik di laboratorium jaringan yang dilengkapi peralatan sesuai kebutuhan industri telekomunikasi.</p>\r\n<p data-start=\"2152\" data-end=\"2606\">Selain penguasaan keterampilan teknis, jurusan ini juga menanamkan sikap profesional, disiplin, dan kemampuan pemecahan masalah. Lulusan Jurusan Teknik Jaringan Akses diharapkan memiliki kompetensi yang siap kerja dan mampu bersaing di dunia usaha dan dunia industri, khususnya di bidang telekomunikasi, penyedia layanan internet (ISP), instalasi jaringan fiber optik, serta memiliki peluang untuk berwirausaha di bidang jasa jaringan dan telekomunikasi.</p>', 'jurusan/1767602838_jurusan-teknik-jaringan-akses.jpeg', '2026-01-05 08:47:18', '2026-01-05 08:47:18'),
(3, 'Jurusan Teknik Tata Busana', 'Ruang Praktik Menjahit, Peralatan Menjahit, Ruang Desain Busana, Ruang Finishing & Pressing', '<p data-start=\"1382\" data-end=\"1762\">Jurusan <strong data-start=\"1390\" data-end=\"1412\">Teknik Tata Busana</strong> merupakan program keahlian yang membekali peserta didik dengan pengetahuan dan keterampilan dalam bidang perancangan, pembuatan, dan penyelesaian busana sesuai dengan perkembangan industri fesyen. Kompetensi yang dipelajari meliputi pembuatan pola busana, teknik menjahit, pemilihan bahan tekstil, serta proses finishing dan penyajian produk busana.</p>\r\n<p data-start=\"1764\" data-end=\"2142\">Peserta didik dilatih untuk mampu menuangkan ide kreatif ke dalam desain busana, menguasai teknik pembuatan busana secara manual maupun menggunakan peralatan modern, serta menerapkan prosedur kerja yang efektif dan aman. Proses pembelajaran dilaksanakan melalui perpaduan teori dan praktik di ruang praktik yang dilengkapi dengan fasilitas dan peralatan sesuai standar industri.</p>\r\n<p data-start=\"2144\" data-end=\"2421\">Selain keterampilan teknis, jurusan ini juga menanamkan sikap kreatif, teliti, disiplin, serta jiwa kewirausahaan. Lulusan Jurusan Teknik Tata Busana diharapkan mampu bekerja di industri garmen, butik, rumah mode, maupun berwirausaha secara mandiri di bidang fesyen dan busana.</p>', 'jurusan/1767602979_jurusan-teknik-tata-busana.jpeg', '2026-01-05 08:49:39', '2026-01-05 08:49:39');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_sekolah`
--

CREATE TABLE `kepala_sekolah` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sambutan` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kepala_sekolah`
--

INSERT INTO `kepala_sekolah` (`id`, `nama`, `foto`, `sambutan`, `created_at`, `updated_at`) VALUES
(1, 'Siti Istiqomah, S.Pd., Gr.', 'kepala_sekolah/SL1oeTwDbBJZFNU3tKRLAYZIQB0NoLvpL0EJO7xd.jpg', 'Assalamu’alaikum warahmatullahi wabarakatuh,\r\nSalam sejahtera untuk kita semua.\r\n\r\nPuji syukur ke hadirat Tuhan Yang Maha Esa atas limpahan rahmat dan karunia-Nya, sehingga SMK Teknologi Bantul senantiasa dapat menjalankan perannya sebagai lembaga pendidikan kejuruan yang berkomitmen mencetak generasi yang terampil, berkarakter, dan siap bersaing di dunia kerja maupun dunia usaha.\r\n\r\nSMK Teknologi Bantul hadir sebagai sekolah vokasi yang menekankan keseimbangan antara penguasaan ilmu pengetahuan, keterampilan praktik, serta pembentukan sikap dan etos kerja. Melalui berbagai program keahlian, pembelajaran berbasis praktik, serta kerja sama dengan dunia industri, kami berupaya membekali peserta didik dengan kompetensi yang relevan dengan kebutuhan zaman.\r\n\r\nKami menyadari bahwa tantangan di era globalisasi dan perkembangan teknologi menuntut lulusan yang adaptif, kreatif, dan berintegritas. Oleh karena itu, SMK Teknologi Bantul terus melakukan peningkatan kualitas pendidikan, baik dari segi sarana dan prasarana, profesionalisme tenaga pendidik, maupun penguatan karakter peserta didik.\r\n\r\nKami mengucapkan terima kasih kepada seluruh guru, tenaga kependidikan, orang tua, mitra industri, serta seluruh pihak yang telah mendukung kemajuan SMK Teknologi Bantul. Semoga kerja sama yang telah terjalin dapat terus ditingkatkan demi mewujudkan lulusan yang unggul, mandiri, dan berdaya saing.\r\n\r\nAkhir kata, semoga SMK Teknologi Bantul dapat terus berkontribusi dalam mencerdaskan kehidupan bangsa dan menghasilkan sumber daya manusia yang berkualitas serta bermanfaat bagi masyarakat.\r\n\r\nWassalamu’alaikum warahmatullahi wabarakatuh.', '2026-01-14 15:44:51', '2026-01-14 15:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `konfigurasi`
--

CREATE TABLE `konfigurasi` (
  `id` bigint UNSIGNED NOT NULL,
  `nama_sekolah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `no_telepon` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konfigurasi`
--

INSERT INTO `konfigurasi` (`id`, `nama_sekolah`, `alamat`, `no_telepon`, `email`, `logo`, `favicon`, `deskripsi`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 'SMK Teknologi Bantul', 'Rendeng RT 01, Timbulharjo, Sewon, Bantul, Yogyakarta 55715.', '0895421741257', 'smkteknologi11@gmail.com', 'konfigurasi/A6LSj32HmB9wSiQzus9BO0TeowASfIphRCcuEYFb.png', 'konfigurasi/QxjYzR2zJxYpCJdih2Lb3NMHmUkzUa618ASj1a8Y.png', 'Sekolah Menengah Kejuruan Bantul yang berfokus pada teknologi dan inovasi untuk menghasilkan tenaga kerja profesional dan berdaya saing tinggi.', 'smk,teknologi,bantul,yogyakarta, Sekolah Menengah Kejuruan', '2025-12-21 03:04:13', '2025-12-21 03:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `media_sosial`
--

CREATE TABLE `media_sosial` (
  `id` bigint UNSIGNED NOT NULL,
  `platform` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media_sosial`
--

INSERT INTO `media_sosial` (`id`, `platform`, `link_url`, `created_at`, `updated_at`, `icon`) VALUES
(1, 'Facebook', 'https://www.facebook.com/share/1CN8LLHF69/', '2025-12-21 05:11:51', '2025-12-21 05:11:51', 'fab fa-facebook'),
(2, 'Tiktiok', 'https://www.tiktok.com/@adibrmd?_r=1&_t=ZS-92PCcrOaiLF', '2025-12-21 05:12:33', '2025-12-21 05:12:33', 'fab fa-tiktok'),
(4, 'Instagram', 'https://www.instagram.com/adibrmd?igsh=c3I3ZXJ5Nmt2a25n', '2025-12-21 05:14:23', '2025-12-21 05:14:23', 'fab fa-instagram'),
(6, 'Youtube', 'https://youtube.com/@adibrahmadi7663?si=Uyo_IS8734KPj8nA', '2025-12-21 06:10:46', '2025-12-21 06:10:46', 'fab fa-youtube');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_15_095405_create_admin_table', 1),
(5, '2025_12_15_095406_create_jurusan_table', 1),
(6, '2025_12_15_095406_create_kepala_sekolah_table', 1),
(7, '2025_12_15_095407_create_carousel_table', 1),
(8, '2025_12_15_095407_create_konfigurasi_table', 1),
(9, '2025_12_15_095407_create_media_sosial_table', 1),
(10, '2025_12_15_095408_create_pengaduan_table', 1),
(11, '2025_12_15_095408_create_prestasi_table', 1),
(12, '2025_12_15_095409_create_artikel_table', 1),
(20, '2025_12_15_095410_create_dokumen_table', 2),
(21, '2025_12_15_095410_create_galeri_table', 2),
(22, '2025_12_15_095411_create_alumni_table', 2),
(23, '2025_12_15_095411_create_guru_table', 2),
(24, '2025_12_15_095412_create_visi_misi_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pesan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kirim` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `nama`, `email`, `pesan`, `tanggal_kirim`, `created_at`, `updated_at`) VALUES
(1, 'dani', 'dani@gmail.com', 'Saya ingin menyampaikan pengaduan terkait kondisi beberapa fasilitas praktik yang sudah kurang layak digunakan. Hal ini cukup menghambat proses pembelajaran siswa. Besar harapan kami pihak sekolah dapat melakukan pengecekan dan perbaikan agar kegiatan belajar mengajar berjalan optimal', '2026-01-08 10:54:07', '2026-01-08 10:54:07', '2026-01-08 10:54:07'),
(2, 'Adi', 'adi@gmail.com', 'Dengan hormat, saya menyampaikan keluhan terkait proses pembelajaran pada salah satu mata pelajaran yang sering mengalami keterlambatan jadwal. Mohon kiranya pihak sekolah dapat melakukan evaluasi agar kegiatan belajar mengajar dapat berjalan sesuai dengan jadwal yang telah ditentukan.', '2026-01-08 10:54:52', '2026-01-08 10:54:52', '2026-01-08 10:54:52'),
(3, 'lana', 'lana@gmail.com', 'Saya ingin mengajukan pengaduan mengenai pelayanan administrasi yang dinilai masih kurang efektif, khususnya terkait lamanya proses pengurusan dokumen. Diharapkan ke depannya pelayanan dapat ditingkatkan demi kenyamanan siswa dan orang tua', '2026-01-08 10:55:25', '2026-01-08 10:55:25', '2026-01-08 10:55:25'),
(4, 'jiwa', 'jiwa@gmail.com', 'Melalui pesan ini, saya menyampaikan keluhan terkait kebersihan dan kenyamanan lingkungan sekolah di beberapa area. Mohon perhatian dari pihak terkait agar kebersihan dapat lebih dijaga demi terciptanya lingkungan belajar yang sehat dan nyaman', '2026-01-08 10:56:05', '2026-01-08 10:56:05', '2026-01-08 10:56:05'),
(5, 'Adib Rahmadi', 'adibrahmad345@gmail.com', 'lingkungan sekolah di beberapa area. Mohon', '2026-01-08 11:06:47', '2026-01-08 11:06:47', '2026-01-08 11:06:47');

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `id` bigint UNSIGNED NOT NULL,
  `judul_prestasi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci,
  `gambar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat` enum('sekolah','kecamatan','kabupaten','provinsi','nasional','internasional') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `peraih` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_perolehan` date DEFAULT NULL,
  `penyelenggara` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`id`, `judul_prestasi`, `deskripsi`, `gambar`, `tingkat`, `peraih`, `tanggal_perolehan`, `penyelenggara`, `created_at`, `updated_at`) VALUES
(2, 'Juara 1 Lomba Kompetensi Siswa (LKS) Teknik Kendaraan Ringan', 'Prestasi ini diraih melalui kemampuan siswa dalam perawatan dan perbaikan kendaraan ringan yang diuji secara teori dan praktik, menunjukkan kompetensi serta kesiapan siswa menghadapi dunia industri otomotif.', 'prestasi/iSPpmBds7XmcZMM1ZlUmytZgSFcBrdFDkVgalpJo.png', 'kabupaten', 'Tim Teknik Kendaraan Ringan SMK Teknologi Bantul', '2020-06-17', 'Kabupaten bantul', '2026-01-14 14:47:55', '2026-01-14 14:53:42'),
(3, 'Juara 2 Lomba Desain Busana Kreatif', 'Prestasi ini diperoleh berkat kreativitas dan inovasi siswa dalam merancang busana yang menggabungkan unsur tradisional dan modern, serta kemampuan teknis menjahit yang berkualitas tinggi.', 'prestasi/EVgtZ1juh2YCRawBIX2AJbdl60ltWcjy0Ib0Bk2h.png', 'provinsi', 'Siswa Jurusan Tata Busana SMK Teknologi Bantul', '2025-12-28', 'Provinsi YK', '2026-01-14 14:52:02', '2026-01-14 14:53:24'),
(4, 'Juara 1 Lomba Jaringan Komputer dan IT Support', 'Keberhasilan ini menunjukkan kemampuan siswa dalam perancangan, instalasi, dan pemeliharaan jaringan komputer sesuai standar industri teknologi informasi.', 'prestasi/DQYVTRraw3l00ESZMRSb9NxvkLzEELjAeyEGkkuF.jpg', 'kabupaten', 'Tim Teknik Jaringan Akses SMK Teknologi Bantul', '2026-01-14', 'Kabupaten bantul', '2026-01-14 14:53:10', '2026-01-14 14:53:10'),
(5, 'Juara Harapan 1 Lomba Karya Inovasi Teknologi Tepat Guna', 'Tim siswa berhasil menciptakan produk teknologi tepat guna yang bermanfaat bagi masyarakat, dengan menekankan aspek efisiensi, kreativitas, dan keberlanjutan.', 'prestasi/j9iCGBmyHI0aUnvqAkUfT4etuNsgKWne9D31KKMD.png', 'provinsi', 'Tim Inovasi Siswa SMK Teknologi Bantul', '2025-11-18', 'Provinsi YK', '2026-01-14 14:54:41', '2026-01-14 14:54:41');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5wHVoxVpnJBWUmSsKF9jTidhNl7Lzul5KAc3duU3', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2pGR2lDZGZyelVwSFFId3VpdmhaOUc3c0xONmZXUjRWMFVObTRDeCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdC9hZG1pbiI7czo1OiJyb3V0ZSI7czoxMToiYWRtaW4ubG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1780391318),
('AYsvEbXK4idVtp8fM8sYGBBVbY7XGQbzZ6O4ikrh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZEtLdndBTzJ3cXU5eDlzZFc2a090MTY3WUoyVWNYd2cwVGl2a0hwTCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780476270),
('DnqindXYXm9ETGkTlxTjzyh9OglzQhiB9rnmuVQI', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSTl5MUh2N2tPWEtDZ1hPU2dzYmUzaTZRUzlBd0N1eDFVZDFnVXhJUCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780489750),
('raHa6DwQmb7JDppeUHf32pSUMkVwq5tOvyA9tDGW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWkZ1UlpZRkYxTWFHNENTeXlOWGZhd01PU3NQUUd5NW82V1dkV2JLOSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1780391321),
('xB0MH79AW9s1mycxVsO1FtK3JKKW7fCX0hoMpdet', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWjVCYUNKRExpYkg3WGdLSFFjNmlaQ1JuQ2FqUUliOXFjdThCYjd1NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJuZXciO2E6MDp7fXM6Mzoib2xkIjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdC9hZG1pbi9hcnRpa2VsIjtzOjU6InJvdXRlIjtzOjE5OiJhZG1pbi5hcnRpa2VsLmluZGV4Ijt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O30=', 1780399518),
('yFltYr51GK05H15dfRV55IbcK3a00BXKcLqDHLdW', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36 Edg/149.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM3RCcTdFTjBDdml3a01SR1J6WlY3TjB6MVp1Mk9FY1JSYXBDdFBrMiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly9zbWt0ZWtub2xvZ2liYW50dWwudGVzdCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1782703969);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id` bigint UNSIGNED NOT NULL,
  `visi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `misi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, 'Mewujudkan lulusan SMK Teknologi Bantul yang kompeten, berkarakter, berdaya saing, dan siap kerja di bidang teknologi serta mampu beradaptasi dengan perkembangan dunia usaha, dunia industri, dan dunia kerja.', 'Menyelenggarakan pendidikan dan pembelajaran kejuruan yang bermutu sesuai dengan perkembangan ilmu pengetahuan, teknologi, dan kebutuhan dunia industri.\r\n\r\nMembekali peserta didik dengan kompetensi keterampilan, pengetahuan, dan sikap profesional sesuai dengan bidang keahliannya.\r\n\r\nMenanamkan nilai-nilai karakter, disiplin, tanggung jawab, dan etos kerja yang tinggi kepada seluruh peserta didik.\r\n\r\nMengembangkan kerja sama dengan dunia usaha dan dunia industri (DUDI) dalam rangka meningkatkan kualitas pembelajaran dan penyerapan lulusan.\r\n\r\nMeningkatkan kemampuan peserta didik dalam berwirausaha, berinovasi, dan beradaptasi terhadap perubahan teknologi.\r\n\r\nMenciptakan lingkungan sekolah yang aman, tertib, dan kondusif untuk mendukung proses pembelajaran yang efektif.', '2026-01-07 10:44:20', '2026-01-07 10:54:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username_unique` (`username`);

--
-- Indexes for table `alumni`
--
ALTER TABLE `alumni`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alumni_jurusan_id_foreign` (`jurusan_id`),
  ADD KEY `idx_alumni_tahun` (`tahun_lulus`);

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `artikel_slug_unique` (`slug`),
  ADD KEY `artikel_penulis_id_foreign` (`penulis_id`),
  ADD KEY `idx_artikel_kategori` (`kategori`),
  ADD KEY `idx_artikel_tanggal` (`tanggal_publish`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokumen_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galeri_uploaded_by_foreign` (`uploaded_by`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_guru_jurusan` (`jurusan_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media_sosial`
--
ALTER TABLE `media_sosial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alumni`
--
ALTER TABLE `alumni`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guru`
--
ALTER TABLE `guru`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kepala_sekolah`
--
ALTER TABLE `kepala_sekolah`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `konfigurasi`
--
ALTER TABLE `konfigurasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media_sosial`
--
ALTER TABLE `media_sosial`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `prestasi`
--
ALTER TABLE `prestasi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumni`
--
ALTER TABLE `alumni`
  ADD CONSTRAINT `alumni_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `artikel`
--
ALTER TABLE `artikel`
  ADD CONSTRAINT `artikel_penulis_id_foreign` FOREIGN KEY (`penulis_id`) REFERENCES `admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `galeri`
--
ALTER TABLE `galeri`
  ADD CONSTRAINT `galeri_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `admin` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `guru`
--
ALTER TABLE `guru`
  ADD CONSTRAINT `guru_jurusan_id_foreign` FOREIGN KEY (`jurusan_id`) REFERENCES `jurusan` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
