<body class="min-h-screen bg-gradient-to-br from-pink-50 to-indigo-50">

    <header class="py-4 text-center text-xl font-bold text-purple-700">
        🌸 正規表現 抽出ハイライト練習ツール 🌸
    </header>

    <main class="px-6 pb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[calc(100vh-120px)]">

            <!-- 対象テキスト -->
            <section class="bg-white/80 backdrop-blur rounded-2xl shadow p-4 flex flex-col">
                <h2 class="text-sm font-semibold text-purple-600 mb-2">対象テキスト</h2>

                <textarea id="text"
                    class="flex-1 resize-none rounded-xl border border-gray-200 p-3 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
2025-12-14 09:01:23 INFO  User miyazaki logged in from 192.168.1.10
2025-12-14 09:02:11 WARN  Invalid email detected: test@example.com
2025-12-14 09:03:55 ERROR ERR-404 Page not found /admin/dashboard
2025-12-14 09:05:01 INFO  Payment succeeded amount=12000JPY user_id=U-92384
2025-12-14 09:06:44 DEBUG Request GET https://api.example.com/v1/users?id=10
2025-12-14 09:07:10 INFO  Logout user_id=U-92384 ip=10.0.0.1

――――――――――――――――――――――――――――――――――――
以下は業務システムの仕様説明とログ混在テキストです。

この文章には、日本語、英語、数字、記号、日付、時刻、
メールアドレス、URL、IPアドレス、エラーコード、ユーザーID、
トランザクションIDなどがランダムに含まれています。

【ユーザー情報】
氏名: 宮崎壮来
メール: miyazaki.sora@example.com
サブメール: miyazaki.sora+dev@gmail.com
登録日: 2024-01-01
最終ログイン: 2025-12-14 09:01:23

【システムURL一覧】
http://localhost:8000/login
http://localhost:8000/logout
https://admin.example.jp/settings
https://api.example.com/v1/users
https://api.example.com/v1/payments?status=success

【IPアドレス】
127.0.0.1
10.0.0.1
172.16.0.5
192.168.1.10

【エラーコード】
ERR-400
ERR-401
ERR-403
ERR-404
ERR-500
ERR-503

【IDパターン】
USER-0001
USER-92384
TX-ABC-999
TX-2025-DEC-001
ORDER-888888

【文章テスト】
ユーザー宮崎壮来は2025年12月14日にログインしました。
同日09時05分に12,000円の決済が完了しました。
その後、管理画面URL https://admin.example.jp/settings にアクセスしました。

【正規表現練習用】
aaa123bbb456ccc
xxx999yyy888zzz
ABC-123-XYZ-999

英語文章:
The system successfully processed the request at 2025-12-14T09:06:44Z.
If an error occurs, please contact support@service.co.jp or admin@example.org.

注意事項:
正規表現で ^ や $ を使うと全文一致になります。
部分抽出を行う場合は、境界を意識してください。
量指定子 + * ? は貪欲にマッチします。

ログ追記:
2025-12-14 10:15:01 INFO User user123@test.co.jp updated profile
2025-12-14 10:15:45 WARN Password attempt failed from 172.16.0.5
2025-12-14 10:16:30 ERROR ERR-401 Unauthorized access detected

補足:
メールアドレスには + 記号が含まれる場合があります。
URL にはクエリパラメータ ?id=10&sort=desc が含まれます。
日付形式は YYYY-MM-DD / YYYY/MM/DD / ISO8601 が混在します。

最終行:
EOF
</textarea>
            </section>

            <!-- 正規表現 -->
            <section class="bg-white/80 backdrop-blur rounded-2xl shadow p-4 flex flex-col">
                <h2 class="text-sm font-semibold text-purple-600 mb-2">正規表現（抽出用）</h2>

                <textarea id="pattern" rows="10"
                    class="rounded-xl border border-gray-200 p-3 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-purple-300">
[\w.+-]+@[\w.-]+\.[a-zA-Z]{2,}
</textarea>

                <div class="mt-4 text-xs text-gray-600 space-y-1">
                    <div>練習例：</div>
                    <div>・メール</div>
                    <div>・日付</div>
                    <div>・URL</div>
                    <div>・IP</div>
                    <div>・エラーコード</div>
                    <div>・ID</div>
                </div>
            </section>

            <!-- ハイライト -->
            <section class="bg-white/80 backdrop-blur rounded-2xl shadow p-4 flex flex-col">
                <h2 class="text-sm font-semibold text-purple-600 mb-2">ハイライト表示</h2>

                <div id="preview"
                    class="flex-1 overflow-y-auto rounded-xl border border-gray-200 p-3 font-mono text-sm whitespace-pre-wrap leading-relaxed bg-gray-50">
                </div>
            </section>

        </div>
    </main>

    <script>
        const textArea = document.getElementById('text');
        const patternInput = document.getElementById('pattern');
        const preview = document.getElementById('preview');

        function escapeHtml(str) {
            return str
                .replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;');
        }

        function render() {
            let regex;
            try {
                regex = new RegExp(patternInput.value, 'g');
            } catch {
                preview.textContent = textArea.value;
                return;
            }

            const raw = textArea.value;
            const safe = escapeHtml(raw);

            preview.innerHTML = safe.replace(regex, m => `<mark>${m}</mark>`);
        }

        textArea.addEventListener('input', render);
        patternInput.addEventListener('input', render);
        render();
    </script>

</body>

</html>