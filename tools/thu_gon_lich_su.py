#!/usr/bin/env python3
"""
Thu gon lich su cap nhat tren cac trang san pham: chi ban MOI NHAT (muc <div class="changelog-item"> dau tien) mo san,
cac muc <div class="changelog-item"> con lai doi thanh <details> (bam tieu de moi xo ra). Chay lai nhieu lan van an toan.

Cach dung (tu thu muc goc web, D:\\KT-SOFT-WEB):
    python tools/thu_gon_lich_su.py            # xu ly 5 trang san pham
    python tools/thu_gon_lich_su.py --check    # chi bao trang nao con nhieu hon 1 muc dang mo (khong sua)
    python tools/thu_gon_lich_su.py san-pham-qlbh-soft.php   # chi 1 trang

Quy uoc khi them ban moi vao trang san pham: dan muc moi LEN DAU danh sach dang <div class="changelog-item" ...> ... </div>
(giong cac muc cu), roi chay script nay - muc cu tu thu gon. Sau do tai trang len hosting.
"""
import os
import re
import sys

PAGES = ['san-pham-qlbh2.php', 'san-pham-qlbh-soft.php', 'san-pham-qlcf-soft.php', 'san-pham-qlcv.php', 'san-pham-ke-toan.php']
ROOT = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))


def fold(text):
    crlf = '\r\n' in text
    lines = text.replace('\r\n', '\n').split('\n')
    out, i, n = [], 0, 0
    while i < len(lines):
        line = lines[i]
        if line.lstrip().startswith('<div class="changelog-item"'):
            n += 1
            j = i + 1
            while not re.match(r'^\s{0,4}</div>\s*$', lines[j]):
                j += 1
            block = lines[i:j]
            if n == 1:
                out.extend(block + [lines[j]])
            else:
                k = 1
                while '</div>' not in block[k]:
                    k += 1
                style = re.search(r'style="([^"]*)"', block[0])
                style = re.sub(r'\s+', ' ', (style.group(1) if style else '').replace('opacity:0.85;', '')).strip()
                hdr = ' '.join(x.strip() for x in block[2:k])
                hdr = hdr.replace('<h3 style="margin:0;">', '<strong>').replace('</h3>', '</strong>')
                out.append('    <details class="changelog-item" style="%s">' % style)
                out.append('      <summary>%s</summary>' % hdr)
                out.append('      <div class="changelog-body">')
                out.extend(block[k + 1:])
                out.append('      </div>')
                out.append('    </details>')
            i = j + 1
            continue
        out.append(line)
        i += 1
    res = '\n'.join(out)
    return (res.replace('\n', '\r\n') if crlf else res), n


def main(argv):
    check = '--check' in argv
    pages = [a for a in argv if not a.startswith('--')] or PAGES
    bad = 0
    for name in pages:
        path = os.path.join(ROOT, name)
        if not os.path.exists(path):
            print('  bo qua (khong co file):', name)
            continue
        text = open(path, encoding='utf-8', newline='').read()
        open_items = len(re.findall(r'<div class="changelog-item"', text))
        if check:
            flag = 'CAN THU GON' if open_items > 1 else 'ok'
            bad += open_items > 1
            print('  %-28s muc dang mo: %d  %s' % (name, open_items, flag))
            continue
        new, n = fold(text)
        if new != text:
            open(path, 'w', encoding='utf-8', newline='').write(new)
            print('  %-28s da thu gon %d muc cu' % (name, n - 1))
        else:
            print('  %-28s khong can doi' % name)
    return 1 if (check and bad) else 0


if __name__ == '__main__':
    sys.exit(main(sys.argv[1:]))
