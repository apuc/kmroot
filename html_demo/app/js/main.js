(function (e) {
    typeof define == "function" && define.amd ? define(["jquery"], e) : typeof module == "object" && module.exports ? module.exports = function (t, n) {
        return n === undefined && (typeof window != "undefined" ? n = require("jquery") : n = require("jquery")(t)), e(n), n
    } : e(jQuery)
})(function (e) {
    function A(t, n, i) {
        typeof i == "string" && (i = {className: i}), this.options = E(w, e.isPlainObject(i) ? i : {}), this.loadHTML(), this.wrapper = e(h.html), this.options.clickToHide && this.wrapper.addClass(r + "-hidable"), this.wrapper.data(r, this), this.arrow = this.wrapper.find("." + r + "-arrow"), this.container = this.wrapper.find("." + r + "-container"), this.container.append(this.userContainer), t && t.length && (this.elementType = t.attr("type"), this.originalElement = t, this.elem = N(t), this.elem.data(r, this), this.elem.before(this.wrapper)), this.container.hide(), this.run(n)
    }

    var t = [].indexOf || function (e) {
                for (var t = 0, n = this.length; t < n; t++)if (t in this && this[t] === e)return t;
                return -1
            }, n = "notify", r = n + "js", i = n + "!blank",
        s = {t: "top", m: "middle", b: "bottom", l: "left", c: "center", r: "right"}, o = ["l", "c", "r"],
        u = ["t", "m", "b"], a = ["t", "b", "l", "r"], f = {t: "b", m: null, b: "t", l: "r", c: null, r: "l"},
        l = function (t) {
            var n;
            return n = [], e.each(t.split(/\W+/), function (e, t) {
                var r;
                r = t.toLowerCase().charAt(0);
                if (s[r])return n.push(r)
            }), n
        }, c = {}, h = {
            name: "core",
            html: '<div class="' + r + '-wrapper">\n <div class="' + r + '-arrow"></div>\n <div class="' + r + '-container"></div>\n</div>',
            css: "." + r + "-corner {\n position: fixed;\n margin: 5px;\n z-index: 1050;\n}\n\n." + r + "-corner ." + r + "-wrapper,\n." + r + "-corner ." + r + "-container {\n position: relative;\n display: block;\n height: inherit;\n width: inherit;\n margin: 3px;\n}\n\n." + r + "-wrapper {\n z-index: 1;\n position: absolute;\n display: inline-block;\n height: 0;\n width: 0;\n}\n\n." + r + "-container {\n display: none;\n z-index: 1;\n position: absolute;\n}\n\n." + r + "-hidable {\n cursor: pointer;\n}\n\n[data-notify-text],[data-notify-html] {\n position: relative;\n}\n\n." + r + "-arrow {\n position: absolute;\n z-index: 2;\n width: 0;\n height: 0;\n}"
        }, p = {"border-radius": ["-webkit-", "-moz-"]}, d = function (e) {
            return c[e]
        }, v = function (e) {
            if (!e)throw"Missing Style name";
            c[e] && delete c[e]
        }, m = function (t, i) {
            if (!t)throw"Missing Style name";
            if (!i)throw"Missing Style definition";
            if (!i.html)throw"Missing Style HTML";
            var s = c[t];
            s && s.cssElem && (window.console && console.warn(n + ": overwriting style '" + t + "'"), c[t].cssElem.remove()), i.name = t, c[t] = i;
            var o = "";
            i.classes && e.each(i.classes, function (t, n) {
                return o += "." + r + "-" + i.name + "-" + t + " {\n", e.each(n, function (t, n) {
                    return p[t] && e.each(p[t], function (e, r) {
                        return o += " " + r + t + ": " + n + ";\n"
                    }), o += " " + t + ": " + n + ";\n"
                }), o += "}\n"
            }), i.css && (o += "/* styles for " + i.name + " */\n" + i.css), o && (i.cssElem = g(o), i.cssElem.attr("id", "notify-" + i.name));
            var u = {}, a = e(i.html);
            y("html", a, u), y("text", a, u), i.fields = u
        }, g = function (t) {
            var n, r, i;
            r = x("style"), r.attr("type", "text/css"), e("head").append(r);
            try {
                r.html(t)
            } catch (s) {
                r[0].styleSheet.cssText = t
            }
            return r
        }, y = function (t, n, r) {
            var s;
            return t !== "html" && (t = "text"), s = "data-notify-" + t, b(n, "[" + s + "]").each(function () {
                var n;
                n = e(this).attr(s), n || (n = i), r[n] = t
            })
        }, b = function (e, t) {
            return e.is(t) ? e : e.find(t)
        }, w = {
            clickToHide: !0,
            autoHide: !0,
            autoHideDelay: 5e3,
            arrowShow: !0,
            arrowSize: 5,
            breakNewLines: !0,
            elementPosition: "bottom",
            globalPosition: "top right",
            style: "bootstrap",
            className: "error",
            showAnimation: "slideDown",
            showDuration: 400,
            hideAnimation: "slideUp",
            hideDuration: 200,
            gap: 5
        }, E = function (t, n) {
            var r;
            return r = function () {
            }, r.prototype = t, e.extend(!0, new r, n)
        }, S = function (t) {
            return e.extend(w, t)
        }, x = function (t) {
            return e("<" + t + "></" + t + ">")
        }, T = {}, N = function (t) {
            var n;
            return t.is("[type=radio]") && (n = t.parents("form:first").find("[type=radio]").filter(function (n, r) {
                return e(r).attr("name") === t.attr("name")
            }), t = n.first()), t
        }, C = function (e, t, n) {
            var r, i;
            if (typeof n == "string") n = parseInt(n, 10); else if (typeof n != "number")return;
            if (isNaN(n))return;
            return r = s[f[t.charAt(0)]], i = t, e[r] !== undefined && (t = s[r.charAt(0)], n = -n), e[t] === undefined ? e[t] = n : e[t] += n, null
        }, k = function (e, t, n) {
            if (e === "l" || e === "t")return 0;
            if (e === "c" || e === "m")return n / 2 - t / 2;
            if (e === "r" || e === "b")return n - t;
            throw"Invalid alignment"
        }, L = function (e) {
            return L.e = L.e || x("div"), L.e.text(e).html()
        };
    A.prototype.loadHTML = function () {
        var t;
        t = this.getStyle(), this.userContainer = e(t.html), this.userFields = t.fields
    }, A.prototype.show = function (e, t) {
        var n, r, i, s, o;
        r = function (n) {
            return function () {
                !e && !n.elem && n.destroy();
                if (t)return t()
            }
        }(this), o = this.container.parent().parents(":hidden").length > 0, i = this.container.add(this.arrow), n = [];
        if (o && e) s = "show"; else if (o && !e) s = "hide"; else if (!o && e) s = this.options.showAnimation, n.push(this.options.showDuration); else {
            if (!!o || !!e)return r();
            s = this.options.hideAnimation, n.push(this.options.hideDuration)
        }
        return n.push(r), i[s].apply(i, n)
    }, A.prototype.setGlobalPosition = function () {
        var t = this.getPosition(), n = t[0], i = t[1], o = s[n], u = s[i], a = n + "|" + i, f = T[a];
        if (!f || !document.body.contains(f[0])) {
            f = T[a] = x("div");
            var l = {};
            l[o] = 0, u === "middle" ? l.top = "45%" : u === "center" ? l.left = "45%" : l[u] = 0, f.css(l).addClass(r + "-corner"), e("body").append(f)
        }
        return f.prepend(this.wrapper)
    }, A.prototype.setElementPosition = function () {
        var n, r, i, l, c, h, p, d, v, m, g, y, b, w, E, S, x, T, N, L, A, O, M, _, D, P, H, B, j;
        H = this.getPosition(), _ = H[0], O = H[1], M = H[2], g = this.elem.position(), d = this.elem.outerHeight(), y = this.elem.outerWidth(), v = this.elem.innerHeight(), m = this.elem.innerWidth(), j = this.wrapper.position(), c = this.container.height(), h = this.container.width(), T = s[_], L = f[_], A = s[L], p = {}, p[A] = _ === "b" ? d : _ === "r" ? y : 0, C(p, "top", g.top - j.top), C(p, "left", g.left - j.left), B = ["top", "left"];
        for (w = 0, S = B.length; w < S; w++)D = B[w], N = parseInt(this.elem.css("margin-" + D), 10), N && C(p, D, N);
        b = Math.max(0, this.options.gap - (this.options.arrowShow ? i : 0)), C(p, A, b);
        if (!this.options.arrowShow) this.arrow.hide(); else {
            i = this.options.arrowSize, r = e.extend({}, p), n = this.userContainer.css("border-color") || this.userContainer.css("border-top-color") || this.userContainer.css("background-color") || "white";
            for (E = 0, x = a.length; E < x; E++) {
                D = a[E], P = s[D];
                if (D === L)continue;
                l = P === T ? n : "transparent", r["border-" + P] = i + "px solid " + l
            }
            C(p, s[L], i), t.call(a, O) >= 0 && C(r, s[O], i * 2)
        }
        t.call(u, _) >= 0 ? (C(p, "left", k(O, h, y)), r && C(r, "left", k(O, i, m))) : t.call(o, _) >= 0 && (C(p, "top", k(O, c, d)), r && C(r, "top", k(O, i, v))), this.container.is(":visible") && (p.display = "block"), this.container.removeAttr("style").css(p);
        if (r)return this.arrow.removeAttr("style").css(r)
    }, A.prototype.getPosition = function () {
        var e, n, r, i, s, f, c, h;
        h = this.options.position || (this.elem ? this.options.elementPosition : this.options.globalPosition), e = l(h), e.length === 0 && (e[0] = "b");
        if (n = e[0], t.call(a, n) < 0)throw"Must be one of [" + a + "]";
        if (e.length === 1 || (r = e[0], t.call(u, r) >= 0) && (i = e[1], t.call(o, i) < 0) || (s = e[0], t.call(o, s) >= 0) && (f = e[1], t.call(u, f) < 0)) e[1] = (c = e[0], t.call(o, c) >= 0) ? "m" : "l";
        return e.length === 2 && (e[2] = e[1]), e
    }, A.prototype.getStyle = function (e) {
        var t;
        e || (e = this.options.style), e || (e = "default"), t = c[e];
        if (!t)throw"Missing style: " + e;
        return t
    }, A.prototype.updateClasses = function () {
        var t, n;
        return t = ["base"], e.isArray(this.options.className) ? t = t.concat(this.options.className) : this.options.className && t.push(this.options.className), n = this.getStyle(), t = e.map(t, function (e) {
            return r + "-" + n.name + "-" + e
        }).join(" "), this.userContainer.attr("class", t)
    }, A.prototype.run = function (t, n) {
        var r, s, o, u, a;
        e.isPlainObject(n) ? e.extend(this.options, n) : e.type(n) === "string" && (this.options.className = n);
        if (this.container && !t) {
            this.show(!1);
            return
        }
        if (!this.container && !t)return;
        s = {}, e.isPlainObject(t) ? s = t : s[i] = t;
        for (o in s) {
            r = s[o], u = this.userFields[o];
            if (!u)continue;
            u === "text" && (r = L(r), this.options.breakNewLines && (r = r.replace(/\n/g, "<br/>"))), a = o === i ? "" : "=" + o, b(this.userContainer, "[data-notify-" + u + a + "]").html(r)
        }
        this.updateClasses(), this.elem ? this.setElementPosition() : this.setGlobalPosition(), this.show(!0), this.options.autoHide && (clearTimeout(this.autohideTimer), this.autohideTimer = setTimeout(this.show.bind(this, !1), this.options.autoHideDelay))
    }, A.prototype.destroy = function () {
        this.wrapper.data(r, null), this.wrapper.remove()
    }, e[n] = function (t, r, i) {
        return t && t.nodeName || t.jquery ? e(t)[n](r, i) : (i = r, r = t, new A(null, r, i)), t
    }, e.fn[n] = function (t, n) {
        return e(this).each(function () {
            var i = N(e(this)).data(r);
            i && i.destroy();
            var s = new A(e(this), t, n)
        }), this
    }, e.extend(e[n], {
        defaults: S,
        addStyle: m,
        removeStyle: v,
        pluginOptions: w,
        getStyle: d,
        insertCSS: g
    }), m("bootstrap", {
        html: "<div>\n<span data-notify-text></span>\n</div>",
        classes: {
            base: {
                "font-weight": "bold",
                padding: "8px 15px 8px 14px",
                "text-shadow": "0 1px 0 rgba(255, 255, 255, 0.5)",
                "background-color": "#fcf8e3",
                border: "1px solid #fbeed5",
                "border-radius": "4px",
                "white-space": "nowrap",
                "padding-left": "25px",
                "background-repeat": "no-repeat",
                "background-position": "3px 7px"
            },
            error: {
                color: "#B94A48",
                "background-color": "#F2DEDE",
                "border-color": "#EED3D7",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAtRJREFUeNqkVc1u00AQHq+dOD+0poIQfkIjalW0SEGqRMuRnHos3DjwAH0ArlyQeANOOSMeAA5VjyBxKBQhgSpVUKKQNGloFdw4cWw2jtfMOna6JOUArDTazXi/b3dm55socPqQhFka++aHBsI8GsopRJERNFlY88FCEk9Yiwf8RhgRyaHFQpPHCDmZG5oX2ui2yilkcTT1AcDsbYC1NMAyOi7zTX2Agx7A9luAl88BauiiQ/cJaZQfIpAlngDcvZZMrl8vFPK5+XktrWlx3/ehZ5r9+t6e+WVnp1pxnNIjgBe4/6dAysQc8dsmHwPcW9C0h3fW1hans1ltwJhy0GxK7XZbUlMp5Ww2eyan6+ft/f2FAqXGK4CvQk5HueFz7D6GOZtIrK+srupdx1GRBBqNBtzc2AiMr7nPplRdKhb1q6q6zjFhrklEFOUutoQ50xcX86ZlqaZpQrfbBdu2R6/G19zX6XSgh6RX5ubyHCM8nqSID6ICrGiZjGYYxojEsiw4PDwMSL5VKsC8Yf4VRYFzMzMaxwjlJSlCyAQ9l0CW44PBADzXhe7xMdi9HtTrdYjFYkDQL0cn4Xdq2/EAE+InCnvADTf2eah4Sx9vExQjkqXT6aAERICMewd/UAp/IeYANM2joxt+q5VI+ieq2i0Wg3l6DNzHwTERPgo1ko7XBXj3vdlsT2F+UuhIhYkp7u7CarkcrFOCtR3H5JiwbAIeImjT/YQKKBtGjRFCU5IUgFRe7fF4cCNVIPMYo3VKqxwjyNAXNepuopyqnld602qVsfRpEkkz+GFL1wPj6ySXBpJtWVa5xlhpcyhBNwpZHmtX8AGgfIExo0ZpzkWVTBGiXCSEaHh62/PoR0p/vHaczxXGnj4bSo+G78lELU80h1uogBwWLf5YlsPmgDEd4M236xjm+8nm4IuE/9u+/PH2JXZfbwz4zw1WbO+SQPpXfwG/BBgAhCNZiSb/pOQAAAAASUVORK5CYII=)"
            },
            success: {
                color: "#468847",
                "background-color": "#DFF0D8",
                "border-color": "#D6E9C6",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAutJREFUeNq0lctPE0Ecx38zu/RFS1EryqtgJFA08YCiMZIAQQ4eRG8eDGdPJiYeTIwHTfwPiAcvXIwXLwoXPaDxkWgQ6islKlJLSQWLUraPLTv7Gme32zoF9KSTfLO7v53vZ3d/M7/fIth+IO6INt2jjoA7bjHCJoAlzCRw59YwHYjBnfMPqAKWQYKjGkfCJqAF0xwZjipQtA3MxeSG87VhOOYegVrUCy7UZM9S6TLIdAamySTclZdYhFhRHloGYg7mgZv1Zzztvgud7V1tbQ2twYA34LJmF4p5dXF1KTufnE+SxeJtuCZNsLDCQU0+RyKTF27Unw101l8e6hns3u0PBalORVVVkcaEKBJDgV3+cGM4tKKmI+ohlIGnygKX00rSBfszz/n2uXv81wd6+rt1orsZCHRdr1Imk2F2Kob3hutSxW8thsd8AXNaln9D7CTfA6O+0UgkMuwVvEFFUbbAcrkcTA8+AtOk8E6KiQiDmMFSDqZItAzEVQviRkdDdaFgPp8HSZKAEAL5Qh7Sq2lIJBJwv2scUqkUnKoZgNhcDKhKg5aH+1IkcouCAdFGAQsuWZYhOjwFHQ96oagWgRoUov1T9kRBEODAwxM2QtEUl+Wp+Ln9VRo6BcMw4ErHRYjH4/B26AlQoQQTRdHWwcd9AH57+UAXddvDD37DmrBBV34WfqiXPl61g+vr6xA9zsGeM9gOdsNXkgpEtTwVvwOklXLKm6+/p5ezwk4B+j6droBs2CsGa/gNs6RIxazl4Tc25mpTgw/apPR1LYlNRFAzgsOxkyXYLIM1V8NMwyAkJSctD1eGVKiq5wWjSPdjmeTkiKvVW4f2YPHWl3GAVq6ymcyCTgovM3FzyRiDe2TaKcEKsLpJvNHjZgPNqEtyi6mZIm4SRFyLMUsONSSdkPeFtY1n0mczoY3BHTLhwPRy9/lzcziCw9ACI+yql0VLzcGAZbYSM5CCSZg1/9oc/nn7+i8N9p/8An4JMADxhH+xHfuiKwAAAABJRU5ErkJggg==)"
            },
            info: {
                color: "#3A87AD",
                "background-color": "#D9EDF7",
                "border-color": "#BCE8F1",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAYAAACNiR0NAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QYFAhkSsdes/QAAA8dJREFUOMvVlGtMW2UYx//POaWHXg6lLaW0ypAtw1UCgbniNOLcVOLmAjHZolOYlxmTGXVZdAnRfXQm+7SoU4mXaOaiZsEpC9FkiQs6Z6bdCnNYruM6KNBw6YWewzl9z+sHImEWv+vz7XmT95f/+3/+7wP814v+efDOV3/SoX3lHAA+6ODeUFfMfjOWMADgdk+eEKz0pF7aQdMAcOKLLjrcVMVX3xdWN29/GhYP7SvnP0cWfS8caSkfHZsPE9Fgnt02JNutQ0QYHB2dDz9/pKX8QjjuO9xUxd/66HdxTeCHZ3rojQObGQBcuNjfplkD3b19Y/6MrimSaKgSMmpGU5WevmE/swa6Oy73tQHA0Rdr2Mmv/6A1n9w9suQ7097Z9lM4FlTgTDrzZTu4StXVfpiI48rVcUDM5cmEksrFnHxfpTtU/3BFQzCQF/2bYVoNbH7zmItbSoMj40JSzmMyX5qDvriA7QdrIIpA+3cdsMpu0nXI8cV0MtKXCPZev+gCEM1S2NHPvWfP/hL+7FSr3+0p5RBEyhEN5JCKYr8XnASMT0xBNyzQGQeI8fjsGD39RMPk7se2bd5ZtTyoFYXftF6y37gx7NeUtJJOTFlAHDZLDuILU3j3+H5oOrD3yWbIztugaAzgnBKJuBLpGfQrS8wO4FZgV+c1IxaLgWVU0tMLEETCos4xMzEIv9cJXQcyagIwigDGwJgOAtHAwAhisQUjy0ORGERiELgG4iakkzo4MYAxcM5hAMi1WWG1yYCJIcMUaBkVRLdGeSU2995TLWzcUAzONJ7J6FBVBYIggMzmFbvdBV44Corg8vjhzC+EJEl8U1kJtgYrhCzgc/vvTwXKSib1paRFVRVORDAJAsw5FuTaJEhWM2SHB3mOAlhkNxwuLzeJsGwqWzf5TFNdKgtY5qHp6ZFf67Y/sAVadCaVY5YACDDb3Oi4NIjLnWMw2QthCBIsVhsUTU9tvXsjeq9+X1d75/KEs4LNOfcdf/+HthMnvwxOD0wmHaXr7ZItn2wuH2SnBzbZAbPJwpPx+VQuzcm7dgRCB57a1uBzUDRL4bfnI0RE0eaXd9W89mpjqHZnUI5Hh2l2dkZZUhOqpi2qSmpOmZ64Tuu9qlz/SEXo6MEHa3wOip46F1n7633eekV8ds8Wxjn37Wl63VVa+ej5oeEZ/82ZBETJjpJ1Rbij2D3Z/1trXUvLsblCK0XfOx0SX2kMsn9dX+d+7Kf6h8o4AIykuffjT8L20LU+w4AZd5VvEPY+XpWqLV327HR7DzXuDnD8r+ovkBehJ8i+y8YAAAAASUVORK5CYII=)"
            },
            warn: {
                color: "#C09853",
                "background-color": "#FCF8E3",
                "border-color": "#FBEED5",
                "background-image": "url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAABJlBMVEXr6eb/2oD/wi7/xjr/0mP/ykf/tQD/vBj/3o7/uQ//vyL/twebhgD/4pzX1K3z8e349vK6tHCilCWbiQymn0jGworr6dXQza3HxcKkn1vWvV/5uRfk4dXZ1bD18+/52YebiAmyr5S9mhCzrWq5t6ufjRH54aLs0oS+qD751XqPhAybhwXsujG3sm+Zk0PTwG6Shg+PhhObhwOPgQL4zV2nlyrf27uLfgCPhRHu7OmLgAafkyiWkD3l49ibiAfTs0C+lgCniwD4sgDJxqOilzDWowWFfAH08uebig6qpFHBvH/aw26FfQTQzsvy8OyEfz20r3jAvaKbhgG9q0nc2LbZxXanoUu/u5WSggCtp1anpJKdmFz/zlX/1nGJiYmuq5Dx7+sAAADoPUZSAAAAAXRSTlMAQObYZgAAAAFiS0dEAIgFHUgAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfdBgUBGhh4aah5AAAAlklEQVQY02NgoBIIE8EUcwn1FkIXM1Tj5dDUQhPU502Mi7XXQxGz5uVIjGOJUUUW81HnYEyMi2HVcUOICQZzMMYmxrEyMylJwgUt5BljWRLjmJm4pI1hYp5SQLGYxDgmLnZOVxuooClIDKgXKMbN5ggV1ACLJcaBxNgcoiGCBiZwdWxOETBDrTyEFey0jYJ4eHjMGWgEAIpRFRCUt08qAAAAAElFTkSuQmCC)"
            }
        }
    }), e(function () {
        g(h.css).attr("id", "core-notify"), e(document).on("click", "." + r + "-hidable", function (t) {
            e(this).trigger("notify-hide")
        }), e(document).on("notify-hide", "." + r + "-wrapper", function (t) {
            var n = e(this).data(r);
            n && n.show(!1)
        })
    })
})
function toggleClass(status, selector, children_1, children_2) {
    if (status == 'default') {
        do_1 = 'default';
        do_2 = 'active';
    } else if (status == 'active') {
        do_1 = 'active';
        do_2 = 'default';
    }
    if (selector && !children_1 && !children_2) {
        $(selector).addClass(do_1);
        $(selector).removeClass(do_2);
    }
    if (selector && children_1 && !children_2) {
        $(selector).children(children_1).addClass(do_1);
        $(selector).children(children_1).removeClass(do_2);
    }
    if (selector && children_1 && children_2) {
        $(selector).children(children_1).children(children_2).addClass(do_1);
        $(selector).children(children_1).children(children_2).removeClass(do_2);
    }
}
function imageResize() {
    w = window.innerWidth;
    $('.responsive-image').each(function (index, el) {
        if (w < 544 && $(this).is('[data-src-x]')) {
            $(this).attr('src', $(this).attr('data-src-x'));
        } else if (w < 768) {
            $(this).attr('src', $(this).attr('data-src-m'));
        } else if (w < 992) {
            $(this).attr('src', $(this).attr('data-src-t'));
        } else {
            $(this).attr('src', $(this).attr('data-src-d'));
        }
    });
}
function open_over(object) {
    $("body").css('overflow-y', 'hidden');
    $(".overlay-photo").addClass('active');
    $(".inner-overlay-image img").attr('src', $(object).attr('data-type-over-img'));
    $(".inner-overlay-caption").html($(object).find(".trailer-caption-hide").html());
    if ($(object).is('[data-type-over-desc]')) {
        $(".inner-overlay-caption").html($($(object).attr('data-type-over-desc')).html());
        $(".inner-overlay-caption").children('.link').attr('href', '' + $(object).attr('data-type-over-img')); /* in '' /load/n?file=*/
        $(".inner-overlay-caption").children('.desc').html($(object).attr('data-type-over-desc-desc'));
    }
}
function get_inform_about_slider(object) {
    if ($(object).is('[data-type!=slider]')) {
        object = $(object).parents('[data-type=slider]');
    }
    array = [];
    array['slider_min'] = parseInt($(object).attr('data-type-slider-min'));
    array['slider_max'] = parseInt($(object).attr('data-type-slider-max'));
    array['slider_bg'] = $(object).find('[data-type-slider=bg]');
    array['slider_fr'] = $(object).find('[data-type-slider=fr]');
    array['left_controller'] = $(object).find('[data-type-slider=left_controller]');
    array['right_controller'] = $(object).find('[data-type-slider=right_controller]');
    array['input_left'] = $(object).find('[data-type-slider=input_left]');
    array['input_right'] = $(object).find('[data-type-slider=input_right]');
    return array;
}
function edit_left_width_slider(obj) {
    if ($(obj).is('[data-type-slider=input_left]')) {
        input = "left";
    }
    if ($(obj).is('[data-type-slider=input_right]')) {
        input = "right";
    }
    ar = get_inform_about_slider(obj);
    val = $(obj).val();
    width = $(ar.slider_bg).width();
    left = parseInt($(obj).css('left'));
    left_count = Math.round((val - ar.slider_min) / (ar.slider_max - ar.slider_min) * width);
    if (input == 'left') {
        if (left_count < 0) {
            left_count = 0;
        }
        if (left_count >= parseInt($(ar.right_controller).css('left'))) {
            left_count = parseInt($(ar.right_controller).css('left')) - 1;
        }
        $(ar.left_controller).css('left', left_count);
    }
    if (input == 'right') {
        if (left_count > width) {
            left_count = width;
        }
        if (left_count <= parseInt($(ar.left_controller).css('left'))) {
            left_count = parseInt($(ar.left_controller).css('left')) + 1;
        }
        $(ar.right_controller).css('left', left_count);
    }
    left_controller = parseInt($(ar.left_controller).css('left'));
    right_controller = parseInt($(ar.right_controller).css('left'));
    $(ar.slider_fr).css('left', left_controller);
    $(ar.slider_fr).css('width', right_controller - left_controller);
}
function pickPosition() {
    if (checkTimeList) {
        $('.time-list .open-help-in').each(function (index, el) {
            if (w <= 544) {
                var spanWidth = $(el).find('span').width();
                $(el).find('.help').css('left', (spanWidth / 2) + 'px');
            } else {
                $(el).find('.help').css('left', '50%');
            }
        });
    }
}
function create_bx_mini_slider() {
    if ($(bx_mini_slider).html() != undefined) {
        bx_mini_slider.destroySlider();
    }
    if (w < 768) {
        bx_mini_slider = {minSlides: 1, maxSlides: 1};
    } else if (w < 992) {
        bx_mini_slider = {minSlides: 3, maxSlides: 3};
    } else {
        bx_mini_slider = {minSlides: 3, maxSlides: 3};
    }
    param_def = {slideWidth: 215, slideMargin: 15, pager: false, nextText: '', prevText: ''};
    var param_def = $.extend(param_def, bx_mini_slider);
    $('.slider-load').css('display', 'block');
    bx_mini_slider = $('.bx-mini-slider').bxSlider(param_def);
}
var checkTimeList = 0;
var sccroll_width = 0;
var obj;
var slider_status = 0;
var coord_x = 0;
var swipe_status = 0;
var mobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent);
var start = mobile ? "touchstart" : "mousedown";
var move = mobile ? "touchmove" : "mousemove";
var end = mobile ? "touchend" : "mouseup";
var bx_mini_slider;
$(window).resize(function () {
    $('body').css('width', window.innerWidth - sccroll_width);
    w = window.innerWidth;
    imageResize();
    pickPosition();
    create_bx_mini_slider();
    $('[data-type-slider=input_left] , [data-type-slider=input_right]').each(function () {
        edit_left_width_slider(this);
    });
    if (w > 768) {
        $('.outer-mobile-nav').removeClass('active');
        $('.outer-mobile-nav').addClass('default');
        $('body').css('overflow-y', 'scroll');
    }
});
$(document).ready(function () {
    sccroll_width = window.innerWidth - $('body').width();
    $('body').css('width', window.innerWidth - sccroll_width);
    w = window.innerWidth;
    imageResize();
    if ($(document).find('.time-list').html() != undefined) {
        checkTimeList = 1;
    }
    pickPosition();
    create_bx_mini_slider();
    $('.bxslider-part').bxSlider({auto: false, minSlides: 1, maxSlides: 1, nextText: '', prevText: '', pager: false});
    $(".mobile-nav-button, .mobile-nav-button__close").on('click', function () {
        if ($('.outer-mobile-nav').is('.default')) {
            $('.outer-mobile-nav').removeClass('default');
            $('.outer-mobile-nav').addClass('active');
            $('body').css('overflow-y', 'hidden');
        } else if ($('.outer-mobile-nav').is('.active')) {
            $('.outer-mobile-nav').removeClass('active');
            $('.outer-mobile-nav').addClass('default');
            $('body').css('overflow-y', 'scroll');
        }
    });
    $(".mobile__select .result").on('click', function () {
        $(".mobile__select .result-list").slideToggle();
    });
    $("[data-type-over-img]").on('click', function (e) {
        e = e || window.event;
        e.preventDefault();
        obj = this;
        open_over(obj);
        return false;
    });
    $(".overlay-photo .next").on('click', function () {
        var parent = $(obj).parents($(obj).attr('data-type-over-parent'));
        var size = $(parent).find('[data-type-over-img]').size();
        var index = $(parent).find('[data-type-over-img]').index(obj);
        if (index + 1 < size) {
            index++;
        } else {
            index = 0;
        }
        obj = $(parent).find('[data-type-over-img]:eq(' + index + ')');
        open_over(obj);
    });
    $(".overlay-photo .prev").on('click', function () {
        var parent = $(obj).parents($(obj).attr('data-type-over-parent'));
        var size = $(parent).find('[data-type-over-img]').size();
        var index = $(parent).find('[data-type-over-img]').index(obj);
        if (index > 0) {
            index--;
        } else {
            index = size - 1;
        }
        obj = $(parent).find('[data-type-over-img]:eq(' + index + ')');
        open_over(obj);
    });
    $(".overlay-photo .close").on('click', function () {
        $('.overlay-photo').removeClass('active');
        $("body").css('overflow-y', 'scroll');
    });
    $(document).mouseup(function (e) {
        if ($('.overlay-photo').is('.active')) {
            var container = $(".inner-overlay-photo");
            var outer = $('.overlay-photo');
            if (container.has(e.target).length === 0) {
                outer.removeClass('active');
                $("body").css('overflow-y', 'scroll');
            }
        }
    });
    $("[data-type-filter-button]").on('click', function () {
        filter = $(this).attr('data-type-filter-button');
        $("[data-type-filter-button][data-type-filter-button != " + filter + "]").removeClass('active');
        $("[data-type-filter-button = " + filter + "]").addClass('active');
        if (filter != 'ALL') {
            $("[data-type-filter]").each(function (index) {
                var attr = $(this).attr('data-type-filter');
                if (-1 === attr.indexOf(filter)) {
                    $(this).addClass('hide');
                } else {
                    $(this).removeClass('hide');
                }
            });
        } else {
            $("[data-type-filter]").removeClass('hide');
        }
    });
    $('[data-type-openclose-button]').click(function () {
        var el = $(this).find('.list-about-item__button');
        if ('СВЕРНУТЬ' == el.text()) {
            el.text('РАЗВЕРНУТЬ');
        } else {
            el.text('СВЕРНУТЬ');
        }
        var elem = $(this).attr('data-type-openclose-button');
        if ($(this).attr('data-type-openclose-class')) {
            $('[data-type-openclose-element = ' + elem + ']').toggleClass($(this).attr('data-type-openclose-class'));
        } else {
            $('[data-type-openclose-element = ' + elem + ']').slideToggle();
        }
    });
    $('[data-type-openclose-parent]').click(function () {
        var elem;
        if ($(this).attr('data-type-openclose-child') == undefined) {
            elem = $(this);
        } else {
            elem = $(this).parents($(this).attr('data-type-openclose-parent')).find($(this).attr('data-type-openclose-child'));
        }
        if ($(this).attr('data-type-openclose-class')) {
            $(elem).toggleClass($(this).attr('data-type-openclose-class'));
        } else {
            $(elem).slideToggle();
        }
    });
    $("[data-type=slider]").each(function () {
        ar = get_inform_about_slider(this);
        $(ar.left_controller).css('left', '0%');
        $(ar.right_controller).css('left', '100%');
        $(ar.input_left).val(ar.slider_min);
        $(ar.input_right).val(ar.slider_max);
        $(ar.slider_fr).css('left', '0%');
        $(ar.slider_fr).css('width', '100%');
    });
    $('[data-type-slider=input_left] , [data-type-slider=input_right]').on('input', function () {
        edit_left_width_slider(this);
    });
    $("[data-type-slider=left_controller] , [data-type-slider=right_controller]").bind(start, function () {
        $('body').attr('onmousedown', 'return false');
        $('body').attr('onselectstart', 'return false');
        if (mobile) {
            event.pageX = event.changedTouches[0].pageX;
        }
        slider_status = 1;
        obj = this;
        if ($(obj).is('[data-type-slider=left_controller]')) {
            controller = "left";
        }
        if ($(obj).is('[data-type-slider=right_controller]')) {
            controller = "right";
        }
        ar = get_inform_about_slider(obj);
        coord_start = event.pageX;
        width = $(ar.slider_bg).width();
        left_start = parseInt($(obj).css('left'));
        $(window).bind(move, function () {
            if (slider_status == 1) {
                if (mobile) {
                    event.pageX = event.changedTouches[0].pageX;
                }
                left = event.pageX - coord_start + left_start;
                left_obj_pos = parseInt($(ar.left_controller).css('left'));
                right_obj_pos = parseInt($(ar.right_controller).css('left'));
                if (0 < left && left < width && (controller == "left" && right_obj_pos - left > 0 || controller == "right" && left - left_obj_pos > 0)) {
                    $(obj).css('left', left);
                    orange_width = right_obj_pos - left_obj_pos;
                    $(ar.slider_fr).css('left', left_obj_pos);
                    $(ar.slider_fr).css('width', orange_width);
                    if (controller == "left") {
                        $(ar.input_left).val(Math.round((ar.slider_max - ar.slider_min) / width * left_obj_pos) + ar.slider_min);
                        $(ar.input_left).trigger('change');
                    }
                    if (controller == "right") {
                        $(ar.input_right).val(Math.round((ar.slider_max - ar.slider_min) / width * right_obj_pos) + ar.slider_min);
                        $(ar.input_right).trigger('change');
                    }
                }
            }
        });
    });
    $(window).bind(end, function () {
        slider_status = 0;
        $('body').attr('onmousedown', false);
        $('body').attr('onselectstart', false);
    });
    $("[data-type-sliderButton]").on('click', function () {
        elem = $(this).attr('data-type-sliderButton');
        group = $(this).attr('data-type-sliderGroup');
        mobile_select = $(this).parents('.mobile__select');
        if (group) {
            toggleClass('default', "[data-type-sliderGroup = " + group + "]");
            toggleClass('active', "[data-type-sliderGroup = " + group + "][data-type-sliderButton = " + elem + "]");
            toggleClass('active', "[data-type-sliderGroup = " + group + "][data-type-sliderElem = " + elem + "]");
        }
        if ($(mobile_select).html() != undefined) {
            $(mobile_select).children('.result').html($(this).html());
            $(mobile_select).children('.result-list').slideUp();
        }
    });
    $('.letters-text-list > li').click(function () {
        if ($('.letters-text-list > li.active').text() == $(this).text()) {
            $('.letters-text-list > li').removeClass('active');
        } else {
            $('.letters-text-list > li').removeClass('active');
            $(this).addClass('active');
        }
    });
    $(window).bind(start, function () {
        if (mobile) {
            event.pageX = event.changedTouches[0].pageX;
        }
        if (w <= 767) {
            var check_active = $('.outer-mobile-nav').is('.active');
            if (event.pageX <= 10 || 1 == 1) {
                var coord_start = event.pageX;
                swipe_status = 1;
                $(window).bind(move, function () {
                    if (swipe_status == 1) {
                        if (mobile) {
                            event.pageX = event.changedTouches[0].pageX;
                        }
                        left = event.pageX - coord_start;
                        $('.outer-mobile-nav').css('opacity', '1');
                        if (!check_active) {
                            if (left >= w / 10) {
                                $('.outer-mobile-nav').css('left', 'calc(-100% + ' + left + 'px)');
                            } else {
                                $('.outer-mobile-nav').attr('style', '');
                            }
                        } else {
                            if (left <= -w / 10) {
                                $('.outer-mobile-nav').css('left', left + 'px');
                            } else {
                                $('.outer-mobile-nav').attr('style', '');
                            }
                        }
                    }
                });
                $(window).bind(end, function () {
                    swipe_status = 0;
                    if (left >= w / 2 && !check_active) {
                        $('.outer-mobile-nav').attr('style', '');
                        $('.outer-mobile-nav').removeClass('default');
                        $('.outer-mobile-nav').addClass('active');
                    } else if (!check_active) {
                        $('.outer-mobile-nav').attr('style', '');
                    }
                    if (-left >= w / 2 && check_active) {
                        $('.outer-mobile-nav').removeClass('active');
                        $('.outer-mobile-nav').addClass('default');
                    } else if (check_active) {
                        $('.outer-mobile-nav').attr('style', '');
                    }
                });
            }
        }
    });
    var typingTimer;
    var doneTypingInterval = 500;
    $('input.search__input').on('keyup', function () {
        $('.search-loader').show();
        clearTimeout(typingTimer);
        typingTimer = setTimeout(search, doneTypingInterval);
    });
    $('input.search__input').on('keydown', function () {
        $('.search-loader').hide();
        clearTimeout(typingTimer);
    });
    function search() {
        if ($('input.search__input').val() != '') {
            $('.row-search-result').addClass('active');
            var me = $(this);
            if (me.data('requestRunning')) {
                return;
            }
            me.data('requestRunning', true);
            $('.search-result_data').html('');
            $('.search-loader').show();
            var query = $('input.search__input').val();
            $.ajax({
                "type": "post", "url": "/search", "data": "q=" + query, "success": function (data) {
                    data = JSON.parse(data);
                    console.log(data);
                    if(0 < data['genre'].length){
                        $('.search-result_data').append('<div class="search-input-result-category"><div class="search-category-result-title"><a href="#">Жанры</a></div>');
                        var genre = '';
                        for(var key in data['genre']){
                            $('.search-result_data').append('<div class="search-input-result-one">' + ' <div class="row-search-result-item">' + ' <div class="search-result-item-left"></div>' + ' <div class="search-result-item-right">' + ' <div class="mini-title"><a href="/genres/films?genre=' + data['genre'][key]['id'] + '">' + data['genre'][key]['name'] + '</a></div>' + '</div>' + '</div>' + '</div>');
                        }
                    }
                    if (0 < data['film'].length) {
                        $('.search-result_data').append('<div class="search-input-result-category"><div class="search-category-result-title"><a href="#">Фильмы</a></div>');
                        for (var key in data['film']) {
                            if (data['film'].hasOwnProperty(key)) {
                                $('.search-result_data').append('<div class="search-input-result-one">' + ' <div class="row-search-result-item">' + ' <div class="search-result-item-left">' + ' <a href="/film/' + data['film'][key]['id'] + '"><img src="' + data['film'][key]['image'] + '" alt=""></a>' + ' </div>' + ' <div class="search-result-item-right">' + ' <div class="mini-title"><a href="/film/' + data['film'][key]['id'] + '">' + data['film'][key]['name_ru'] + '</a></div>' + '<div class="mini-dop-title"><a href="/film/' + data['film'][key]['id'] + '">' + data['film'][key]['name_origin'] + '</a></div>' + '</div>' + '</div>' + '</div>');
                            }
                        }
                        $('.search-result_data').append('</div>');
                    }
                    if (0 < data['person'].length) {
                        $('.search-result_data').append('<div class="search-input-result-category"><div class="search-category-result-title"><a href="#">Персоны</a></div>');
                        for (var key in data['person']) {
                            if (data['person'].hasOwnProperty(key)) {
                                $('.search-result_data').append('<div class="search-input-result-one">' + ' <div class="row-search-result-item">' + ' <div class="search-result-item-left">' + ' <a href="/people/' + data['person'][key]['id'] + '"><img src="' + data['person'][key]['image'] + '" alt=""></a>' + ' </div>' + ' <div class="search-result-item-right">' + ' <div class="mini-title"><a href="/people/' + data['person'][key]['id'] + '">' + data['person'][key]['name_ru'] + '</a></div>' + '<div class="mini-dop-title"><a href="/people/' + data['person'][key]['id'] + '">' + data['person'][key]['name_origin'] + '</a></div>' + '</div>' + '</div>' + '</div>');
                            }
                        }
                        $('.search-result_data').append('</div>');
                    }
                    if (0 < data['news'].length) {
                        $('.search-result_data').append('<div class="search-input-result-category"><div class="search-category-result-title"><a href="#">Новости</a></div>');
                        for (var key in data['news']) {
                            if (data['news'].hasOwnProperty(key)) {
                                $('.search-result_data').append('<div class="search-input-result-one">' + ' <div class="row-search-result-item">' + ' <div class="search-result-item-left">' + ' <a href="/' + data['news'][key]['category'] + '/' + data['news'][key]['id'] + '"><img src="' + data['news'][key]['image'] + '" alt=""></a>' + ' </div>' + ' <div class="search-result-item-right">' + ' <div class="mini-title"><a href="/' + data['news'][key]['category'] + '/' + data['news'][key]['id'] + '">' + data['news'][key]['name_ru'] + '</a></div>' + '<div class="mini-dop-title"><a href="/' + data['news'][key]['category'] + '/' + data['news'][key]['id'] + '">' + data['news'][key]['name_origin'] + '</a></div>' + '</div>' + '</div>' + '</div>');
                            }
                        }
                        $('.search-result_data').append('</div>');
                    }
                    $('.search-result_data').append('<div class="search-input-result-bottom"><a class="" id="submit_search" href="#">Показать все результаты <i class="content-icon content-icon__arrow"></i></a></div>');
                    $('#submit_search').click(function (e) {
                        e = e || window.event;
                        e.preventDefault();
                        $('#search_form').submit();
                        return false;
                    })
                }, complete: function () {
                    me.data('requestRunning', false);
                    $('.search-loader').hide();
                }, error: function () {
                    me.data('requestRunning', false);
                    $('.search-loader').hide();
                }, timeout: 5000
            });
        } else {
            $('.row-search-result').removeClass('active');
        }
    }

    $('[data-news]').mouseover(function () {
        var elem = $(this).attr('data-news');
        $('[data-news-element]').removeClass('active');
        $('[data-news-element=' + elem + ']').addClass('active');
    });


    /*for header*/
    $(document).on('click', '.search-film', function () {
        $('div .search-form').show();
        return false;
    });

});