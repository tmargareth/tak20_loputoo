!(function (t) {
    function e(o) {
        if (n[o]) return n[o].exports;
        var i = (n[o] = { i: o, l: !1, exports: {} });
        return t[o].call(i.exports, i, i.exports, e), (i.l = !0), i.exports;
    }
    var n = {};
    (e.m = t),
        (e.c = n),
        (e.d = function (t, n, o) {
            e.o(t, n) || Object.defineProperty(t, n, { configurable: !1, enumerable: !0, get: o });
        }),
        (e.n = function (t) {
            var n =
                t && t.__esModule
                    ? function () {
                          return t.default;
                      }
                    : function () {
                          return t;
                      };
            return e.d(n, "a", n), n;
        }),
        (e.o = function (t, e) {
            return Object.prototype.hasOwnProperty.call(t, e);
        }),
        (e.p = ""),
        e((e.s = 0));
})([
    function (t, e) {
        !(function () {
            this.Timer = function () {
                function t() {
                    setInterval(function () {
                        if (!n.options.isStoped) {
                            if ((n.options.time.second--, 0 == n.options.time.hour && 0 == n.options.time.minute && -1 == n.options.time.second)) return n.stop();
                            -1 == n.options.time.second &&
                                ((n.options.time.second = -1 == n.options.time.minute ? 0 : 59), n.options.time.minute--, -1 == n.options.time.minute && ((n.options.time.minute = -1 == n.options.time.hour ? 0 : 59), n.options.time.hour--)),
                                e();
                                // Taimeri heli
                                if(n.options.time.second == 0 && n.options.time.minute == 0 && n.options.time.hour == 0){
                                    let sound = $('input[name="answer"]:checked').attr('src');
                                    console.log(sound);
                                    let audio = new Audio(sound);  
                                    audio.play();
                                }
                        }
                        
                        
                    }, 1e3);
                }
                function e() {
                    let t = n.options.time.second,
                        e = n.options.time.minute,
                        o = n.options.time.hour;
                    (n.secondElement.innerHTML = t <= 9 ? "0" + t : t), (n.minuteElement.innerHTML = e <= 9 ? "0" + e + ":" : e + ":"), (n.hourElement.innerHTML = o <= 9 ? "0" + o + ":" : o + ":");
                }
                (this.options = { el: ".timer", time: { second: 0, minute: 0, hour: 0 }, isStoped: !1 }),
                    arguments.length &&
                        "object" == typeof arguments[0] &&
                        (function (t, e) {
                            for (let n in e) t.hasOwnProperty(n) && (t[n] = e[n]);
                        })(this.options, arguments[0]);
                let n = this;
                (this.get = function (t) {
                    return this.options.time[t];
                }),
                    (this.set = function (t, n) {
                        (this.options.time[t] = n), e();
                    }),
                    (this.pause = function () {
                        (this.options.isStoped = !0), e();
                    }),
                    (this.stop = function () {
                        (this.options.time.second = 0), (this.options.time.minute = 0), (this.options.time.hour = 0), (this.options.isStoped = !0), e();
                    }),
                    (this.resume = function () {
                        (this.options.isStoped = !1), e();
                    }),
                    (function () {
                        let o = document.querySelector(n.options.el),
                            i = document.createElement("span");
                        (i.className = "hour"), (n.hourElement = o.appendChild(i));
                        let s = document.createElement("span");
                        (s.className = "minute"), (n.minuteElement = o.appendChild(s));
                        let u = document.createElement("span");
                        (u.className = "second"), (n.secondElement = o.appendChild(u)), e(), t();
                    })();
            };
        })();
    },
]);
