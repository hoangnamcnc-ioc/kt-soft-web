#!/usr/bin/env python3
"""
Sinh cac trang giai phap theo nganh (landing page SEO) tu du lieu ben duoi. Chay: python tools/tao_trang_nganh.py
Moi trang dung chung inc_header/inc_footer, co FAQ (kem du lieu cau truc FAQPage) va nut tai/dung thu dung san pham.
Noi dung CHI neu tinh nang co that cua tung san pham (doi chieu voi cac trang san-pham-*.php) - khi san pham them tinh nang thi sua du lieu o day roi chay lai.
"""
import html
import json
import os

ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

PRODUCTS = {
    'cloud': dict(name='QLBH-CLOUD', tag='☁️ Chạy trên trình duyệt · Đa chi nhánh', accent='qlbh2', icon='🛒',
                  link='san-pham-qlbh2.php', cta_href='https://app.kt-soft.vn/dang-ky.php', cta='Dùng thử QLBH-CLOUD miễn phí 12 tháng',
                  blurb='Bán hàng POS, kho, lô/hạn dùng, công nợ, khuyến mại, sổ quỹ và phân tích kinh doanh — truy cập từ máy tính hoặc điện thoại, không cần cài đặt.'),
    'soft': dict(name='QLBH-SOFT', tag='💻 Cài trên máy · Chạy offline', accent='qlbhsoft', icon='💻',
                 link='san-pham-qlbh-soft.php', cta_href='download.php?p=qlbh-soft', cta='Tải QLBH-SOFT',
                 blurb='Bán hàng bằng mã vạch, tồn kho, công nợ, ước tính thuế — dữ liệu nằm ngay trên máy của bạn, mất mạng vẫn bán bình thường.'),
    'cf': dict(name='QLCF-SOFT', tag='☕ Cài trên máy Windows', accent='qlcf', icon='☕',
               link='san-pham-qlcf-soft.php', cta_href='download.php?p=qlcf-soft', cta='Tải QLCF-SOFT miễn phí',
               blurb='Bán hàng bấm ly theo size/đường/đá/topping, in tem ly, màn hình pha chế, công thức tự trừ kho nguyên liệu và chốt ca.'),
    'ketoan': dict(name='KT-SOFT Kế toán', tag='🧾 Cài trên máy · Thông tư 133/2016', accent='ketoan', icon='🧾',
                   link='san-pham-ke-toan.php', cta_href='download.php?p=ke-toan', cta='Tải KT-SOFT Kế toán',
                   blurb='Sổ sách theo Thông tư 133/2016/TT-BTC, hóa đơn đầu vào/đầu ra, tờ khai thuế, phát hành hóa đơn điện tử qua Viettel S-Invoice.'),
}

PAGES = [
    dict(
        file='phan-mem-quan-ly-tap-hoa.php',
        title='Phần mềm quản lý tạp hóa, siêu thị mini — bán nhanh, kiểm soát hạn dùng | KT-SOFT',
        desc='Phần mềm quản lý tạp hóa, siêu thị mini: quét mã vạch, tồn kho, lô và hạn sử dụng, công nợ, đóng mở ca, nhập hàng từ KiotViet/Sapo. Dùng thử miễn phí 12 tháng.',
        kicker='Tạp hóa · Siêu thị mini',
        h1='Phần mềm quản lý tạp hóa, siêu thị mini — bán nhanh, không để hết hàng hay quá hạn',
        lead='Hàng nghìn mã hàng nhỏ lẻ, khách ghi nợ, nhân viên thay ca — nếu chỉ nhớ và ghi sổ thì rất dễ thất thoát. KT-SOFT giúp bạn nắm số liệu thật mỗi ngày.',
        pains=['Hết hàng bán chạy lúc đông khách, trong khi hàng ế vẫn nằm đó',
               'Hàng cận date hoặc hết hạn mới phát hiện khi đã quá muộn',
               'Khách ghi nợ lâu ngày quên đòi, công nợ nhà cung cấp quên trả đúng hạn',
               'Kiểm kho tốn cả ngày mà vẫn lệch, không biết hao hụt vì đâu',
               'Đổi từ phần mềm khác sang phải nhập lại cả nghìn mặt hàng'],
        features=[('📦', 'Kho và hạn sử dụng', 'Quản lý tồn từng chi nhánh, lô hàng kèm hạn dùng, cảnh báo cận date, xuất hủy có lý do, báo cáo vốn chôn vào hàng ế.'),
                  ('🔎', 'Gợi ý nhập hàng thông minh', 'Dự báo theo tốc độ bán thật và xu hướng, tạo luôn đơn đặt hàng nhập nháp theo nhà cung cấp gần nhất.'),
                  ('💳', 'Công nợ và nhắc nợ', 'Công nợ khách và nhà cung cấp kèm hạn trả; xếp khách theo khả năng đòi được, soạn sẵn tin nhắn nhắc nợ.'),
                  ('🕒', 'Đóng mở ca, chống thất thoát', 'Đối chiếu tiền mặt đầu/cuối ca, cảnh báo huỷ đơn bất thường, bán dưới giá vốn, chênh lệch két lặp lại.'),
                  ('📲', 'Chuyển nhanh từ KiotViet/Sapo', 'Nhập file Excel xuất từ phần mềm cũ: tự nhận nhóm hàng 3 cấp, thương hiệu, tồn kho, giá vốn, giá bán.')],
        products=['cloud', 'soft'],
        faq=[('Phần mềm có miễn phí không?', 'QLBH-CLOUD dùng thử miễn phí đầy đủ tính năng 12 tháng đầu, sau đó gia hạn theo năm. QLBH-SOFT bạn tải về dùng thử, liên hệ để biết giá theo nhu cầu.'),
             ('Mất mạng có bán hàng được không?', 'QLBH-SOFT cài trên máy và chạy offline. Với QLBH-CLOUD, màn hình bán hàng giữ các đơn đã lập khi mất mạng và tự gửi lại khi có mạng trở lại.'),
             ('Tôi đang dùng KiotViet/Sapo, chuyển sang có khó không?', 'Bạn xuất danh sách hàng hóa và khách hàng ra Excel (.xlsx) rồi nhập vào QLBH-CLOUD; hệ thống tự nhận cột và cho xem trước trước khi ghi dữ liệu thật.')],
    ),
    dict(
        file='phan-mem-quan-ly-quan-ca-phe.php',
        title='Phần mềm quản lý quán cà phê, trà sữa — bấm ly nhanh, trừ kho tự động | KT-SOFT',
        desc='Phần mềm quản lý quán cà phê, trà sữa QLCF-SOFT: bán hàng bấm ly theo size/đường/đá/topping, in tem ly, màn hình pha chế, công thức trừ kho nguyên liệu, chốt ca. Tải miễn phí.',
        kicker='Quán cà phê · Trà sữa',
        h1='Phần mềm quản lý quán cà phê, trà sữa — bấm ly nhanh, trừ nguyên liệu tự động',
        lead='Giờ cao điểm khách xếp hàng, ly nào cũng khác size, đường, đá, topping. QLCF-SOFT giúp thu ngân bấm vài lần là xong, pha chế nhìn màn hình là làm, và cuối ca biết chính xác hao hụt.',
        pains=['Thu ngân bấm chậm lúc đông, nhầm size/đường/đá làm khách phàn nàn',
               'Pha chế không biết ly nào làm trước, ly nào của bàn nào',
               'Nguyên liệu hao hụt nhưng không biết thất thoát ở đâu',
               'Chốt ca lệch tiền, giao ca không có ghi chú rõ ràng',
               'Xếp lịch và đổi ca nhân viên bằng tin nhắn nhóm, dễ nhầm'],
        features=[('☕', 'Bán hàng bấm ly', 'Chọn món, size, đường, đá, topping chỉ bằng vài lần bấm; in tem ly theo số ly; màn hình pha chế hiện hàng đợi.'),
                  ('🪑', 'Khu vực và bàn', 'Quản lý khu vực, bàn, bàn đặt trước; thanh toán bằng tiền mặt hoặc mã QR chuyển khoản VietQR.'),
                  ('🧪', 'Công thức và kho nguyên liệu', 'Khai báo công thức pha chế, bán là tự trừ kho, cảnh báo sắp hết, đối soát hao hụt, hạn sử dụng nguyên liệu.'),
                  ('🕒', 'Chốt ca và bàn giao', 'Mở/đóng ca đối chiếu tiền mặt, ghi chú bàn giao cho ca sau, checklist việc đầu ca/cuối ca.'),
                  ('📅', 'Lịch làm việc và lương', 'Xếp ca theo tuần, nhân viên xin đổi ca, chấm công, bảng lương theo giờ kèm thưởng/phạt.')],
        products=['cf'],
        faq=[('QLCF-SOFT có dùng được cho quán nhiều chi nhánh không?', 'Có. Phần mềm hỗ trợ nhiều chi nhánh và phân quyền chủ quán, quản lý, thu ngân.'),
             ('Dữ liệu của quán lưu ở đâu?', 'Phần mềm cài trên máy Windows của bạn, dữ liệu lưu trong thư mục riêng; có chức năng sao lưu và khôi phục dữ liệu.'),
             ('Cài đè bản mới có mất dữ liệu không?', 'Không. Cài bản mới đè lên bản cũ, dữ liệu bán hàng, thực đơn, kho được giữ nguyên.')],
    ),
    dict(
        file='phan-mem-ban-hang-nhieu-chi-nhanh.php',
        title='Phần mềm bán hàng nhiều chi nhánh — tồn kho riêng, chuyển hàng, báo cáo gộp | KT-SOFT',
        desc='Phần mềm quản lý bán hàng nhiều chi nhánh QLBH-CLOUD: tồn kho từng chi nhánh, chuyển hàng có xác nhận hai chiều, phân quyền theo chi nhánh, báo cáo gộp, đặt hàng online. Dùng thử 12 tháng.',
        kicker='Chuỗi cửa hàng · Nhiều chi nhánh',
        h1='Phần mềm bán hàng nhiều chi nhánh — xem cả chuỗi trên một màn hình',
        lead='Mỗi chi nhánh một kho, một đội thu ngân — nhưng chủ cửa hàng cần thấy số liệu chung. QLBH-CLOUD chạy trên trình duyệt nên chủ ở đâu cũng xem được, nhân viên chỉ thấy đúng chi nhánh của mình.',
        pains=['Không biết chi nhánh nào đang thừa, chi nhánh nào thiếu hàng',
               'Chuyển hàng giữa các chi nhánh bằng giấy hoặc tin nhắn, dễ thất lạc',
               'Nhân viên chi nhánh này xem được số liệu chi nhánh khác',
               'Báo cáo cuối ngày phải gom từng nơi gửi về',
               'Khách mua ở chi nhánh nào cũng muốn được tích điểm chung'],
        features=[('🏬', 'Kho riêng từng chi nhánh', 'Tồn kho tách theo chi nhánh; thu ngân chỉ thấy số liệu chi nhánh mình.'),
                  ('🔁', 'Chuyển hàng hai chiều', 'Phiếu chuyển hàng có xác nhận bên gửi và bên nhận, không thất lạc.'),
                  ('🔐', 'Phân quyền theo vai trò', 'Quản trị, quản lý, thu ngân và vai trò tùy chỉnh (thủ kho, thủ quỹ…) theo từng khu vực chức năng.'),
                  ('📊', 'Báo cáo và phân tích', 'Doanh thu, lãi gộp, hàng bán chạy, dòng tiền 14 ngày, điểm sức khỏe cửa hàng, cảnh báo bất thường.'),
                  ('🎁', 'Khách hàng thân thiết', 'Tích điểm đổi quà, hạng thành viên, khuyến mại và mã giảm giá áp dụng toàn chuỗi.')],
        products=['cloud'],
        faq=[('Có giới hạn số chi nhánh hoặc số đơn không?', 'Bản dùng thử có đầy đủ tính năng như bản trả phí, không giới hạn số đơn hàng hay sản phẩm.'),
             ('Dùng được trên điện thoại không?', 'Được. QLBH-CLOUD chạy trên trình duyệt và có thể cài như một ứng dụng trên điện thoại.'),
             ('Dữ liệu của chi nhánh này có bị lộ cho cửa hàng khác không?', 'Không. Dữ liệu mỗi cửa hàng được tách riêng hoàn toàn và hệ thống được kiểm thử thường xuyên để bảo đảm điều đó.')],
    ),
    dict(
        file='phan-mem-ke-toan-ho-kinh-doanh.php',
        title='Phần mềm kế toán và ước tính thuế hộ kinh doanh, doanh nghiệp nhỏ | KT-SOFT',
        desc='Phần mềm kế toán theo Thông tư 133 cho doanh nghiệp nhỏ và công cụ ước tính thuế GTGT/TNCN, sổ doanh thu cho hộ kinh doanh. Hóa đơn điện tử qua Viettel S-Invoice.',
        kicker='Hộ kinh doanh · Doanh nghiệp nhỏ',
        h1='Phần mềm kế toán và ước tính thuế cho hộ kinh doanh, doanh nghiệp nhỏ',
        lead='Hộ kinh doanh cần sổ doanh thu và biết mình sắp chạm ngưỡng thuế nào; doanh nghiệp nhỏ cần sổ sách theo Thông tư 133 và hóa đơn điện tử. KT-SOFT có phần mềm phù hợp cho từng nhóm.',
        pains=['Không biết doanh thu đã gần ngưỡng chịu thuế chưa',
               'Ghi sổ doanh thu, chi phí thủ công, dễ sai và mất thời gian',
               'Phải đối chiếu hóa đơn điện tử mua vào/bán ra với sổ sách',
               'Lập tờ khai thuế mỗi kỳ tốn công',
               'Thay đổi quy định thuế liên tục, khó theo dõi'],
        features=[('🧮', 'Ước tính thuế hộ kinh doanh', 'QLBH-CLOUD và QLBH-SOFT ước tính thuế GTGT/TNCN theo ngưỡng và tỷ lệ hiện hành, kèm sổ doanh thu bán hàng, dịch vụ theo mẫu.'),
                  ('📒', 'Sổ sách theo Thông tư 133', 'KT-SOFT Kế toán: sổ sách, bảng cân đối kế toán, kết quả kinh doanh theo đúng mẫu Thông tư 133/2016/TT-BTC.'),
                  ('🧾', 'Hóa đơn điện tử', 'Tải hóa đơn điện tử mua vào/bán ra từ Tổng cục Thuế để đối chiếu; phát hành hóa đơn điện tử qua Viettel S-Invoice ngay trong phần mềm.'),
                  ('📑', 'Tờ khai và báo cáo', 'Hỗ trợ lập tờ khai thuế GTGT, TNCN, TNDN; xuất báo cáo, bảng kê dạng Excel/XML.'),
                  ('🔒', 'Dữ liệu nằm trên máy bạn', 'Phần mềm kế toán lưu toàn bộ dữ liệu trên máy của bạn, mật khẩu người dùng được mã hóa.')],
        products=['ketoan', 'cloud'],
        faq=[('Số liệu ước tính thuế có thay thế kế toán không?', 'Không. Đây là công cụ ước tính để tham khảo theo dữ liệu bạn nhập, không thay thế tư vấn của kế toán hay cơ quan thuế.'),
             ('Hộ kinh doanh nên dùng phần mềm nào?', 'Nếu bán lẻ, QLBH-CLOUD hoặc QLBH-SOFT đã có ước tính thuế và sổ doanh thu. Nếu cần kế toán đầy đủ theo Thông tư 133 thì dùng KT-SOFT Kế toán.'),
             ('Có phát hành được hóa đơn điện tử không?', 'KT-SOFT Kế toán hỗ trợ phát hành hóa đơn điện tử qua Viettel S-Invoice (cần tài khoản dịch vụ hóa đơn của bạn).')],
    ),
]

STYLE_EXTRA = ''


def esc(s):
    return html.escape(s, quote=True)


def render(p):
    pain = ''.join('<li>%s</li>' % esc(x) for x in p['pains'])
    feats = ''
    for icon, name, text in p['features']:
        feats += ('<div class="product-card" style="--card-accent: var(--%s); --card-bg: var(--%s-bg);"><div class="icon-blob">%s</div>'
                  '<h3>%s</h3><p>%s</p></div>\n' % (PRODUCTS[p['products'][0]]['accent'], PRODUCTS[p['products'][0]]['accent'], icon, esc(name), esc(text)))
    prods = ''
    for key in p['products']:
        pr = PRODUCTS[key]
        ext = ' target="_blank" rel="noopener"' if pr['cta_href'].startswith('http') else ''
        prods += ('<div class="product-card" style="--card-accent: var(--%s); --card-bg: var(--%s-bg);"><div class="icon-blob">%s</div>'
                  '<span class="tag">%s</span><h3>%s</h3><p>%s</p>'
                  '<a href="%s" class="card-link">Xem chi tiết →</a> &nbsp; <a href="%s" class="card-link"%s>%s →</a></div>\n'
                  % (pr['accent'], pr['accent'], pr['icon'], esc(pr['tag']), esc(pr['name']), esc(pr['blurb']), pr['link'], pr['cta_href'], ext, esc(pr['cta'])))
    faq_html = ''
    for q, a in p['faq']:
        faq_html += '<details class="faq-item"><summary>%s</summary><p>%s</p></details>\n' % (esc(q), esc(a))
    ld = {"@context": "https://schema.org", "@type": "FAQPage",
          "mainEntity": [{"@type": "Question", "name": q, "acceptedAnswer": {"@type": "Answer", "text": a}} for q, a in p['faq']]}
    first = PRODUCTS[p['products'][0]]
    return """<?php
// Trang giai phap theo nganh - SINH TU DONG boi tools/tao_trang_nganh.py (sua du lieu trong script roi chay lai, dung sua tay file nay).
$pageTitle = %(title)s;
$pageDesc = %(desc)s;
require_once __DIR__ . '/inc_header.php';
?>

<section class="hero" style="padding-bottom:0;">
  <div class="container">
    <span class="eyebrow">%(kicker)s</span>
    <h1>%(h1)s</h1>
    <p class="lead">%(lead)s</p>
    <div class="cta-row">
      <a href="%(cta_href)s" class="btn"%(cta_ext)s>%(cta)s</a>
      <a href="lien-he.php" class="btn btn-ghost">Yêu cầu tư vấn</a>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="kicker">Bạn đang gặp</span>
      <h2>Những chuyện quen thuộc mỗi ngày</h2>
    </div>
    <ul class="feature-list" style="--card-accent: var(--%(accent)s);max-width:760px;">%(pain)s</ul>
  </div>
</section>

<section class="section" style="background:#f8fafc;">
  <div class="container">
    <div class="section-head">
      <span class="kicker">Giải pháp</span>
      <h2>KT-SOFT giúp bạn thế nào</h2>
    </div>
    <div class="product-grid">
%(feats)s    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="section-head">
      <span class="kicker">Phần mềm phù hợp</span>
      <h2>Chọn phần mềm cho đúng nhu cầu</h2>
    </div>
    <div class="product-grid">
%(prods)s    </div>
  </div>
</section>

<section class="section" style="background:#f8fafc;">
  <div class="container" style="max-width:820px;">
    <div class="section-head">
      <span class="kicker">Câu hỏi thường gặp</span>
      <h2>Giải đáp nhanh</h2>
    </div>
%(faq)s  </div>
</section>

<section class="section">
  <div class="container">
    <div class="cta-band">
      <div>
        <h2>Bắt đầu ngay hôm nay</h2>
        <p>Dùng thử không rủi ro, cần tư vấn chọn phần mềm phù hợp thì để lại thông tin, KT-SOFT liên hệ lại.</p>
      </div>
      <a href="%(cta_href)s" class="btn"%(cta_ext)s>%(cta)s</a>
    </div>
  </div>
</section>

<script type="application/ld+json">%(ld)s</script>

<?php require_once __DIR__ . '/inc_footer.php'; ?>
""" % dict(
        title=json.dumps(p['title'], ensure_ascii=False), desc=json.dumps(p['desc'], ensure_ascii=False),
        kicker=esc(p['kicker']), h1=esc(p['h1']), lead=esc(p['lead']), cta_href=first['cta_href'], cta=esc(first['cta']),
        cta_ext=' target="_blank" rel="noopener"' if first['cta_href'].startswith('http') else '', accent=first['accent'],
        pain=pain, feats=feats, prods=prods, faq=faq_html, ld=json.dumps(ld, ensure_ascii=False).replace('</', '<\\/'))


def main():
    for p in PAGES:
        path = os.path.join(ROOT, p['file'])
        with open(path, 'w', encoding='utf-8', newline='') as f:
            f.write(render(p))
        print('da tao', p['file'])


if __name__ == '__main__':
    main()
