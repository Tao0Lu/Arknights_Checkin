require('../config')
const CryptoJS = require('CryptoJS')
module.exports = {
  randomDigits(length) {
    const max = 9
    const min = 0
    let output = ''

    for (i = 1; i < length; ++i) {
      random = ~(Math.random() * (max + 1 - min)) + min
      output += str(random)
    }

    return output
  },
  randomString(length) {
    if (length > 64) return false // sha256 算法限制
    return sha256(CryptoJS.lib.WordArray.random(128 / 8)).slice(0, length)
    // TODO: 我也不知道这里为什么用sha256。word array的可行性会稍后验证。
  },
  randomDeviceId = () => CryptoJS.md5(this.randomString(12)),
  randomDeviceId2 = () => '86' + this.randomDigits(13),
  randomDeviceId3 = () => CryptoJS.md5(this.randomString(12)),
  u8_sign = (data) => CryptoJS.HmacSHA1(data, HMAC_KEY)
}
