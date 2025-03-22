/**
 * Swap generated URL placeholders ({page}, {id}, etc.) with real values
 * @param url 
 * @param replacements 
 * @returns {string}
 */
export function swap_placeholders(url: string, replacements: Record<string, string|number>): string {
    return Object.entries(replacements)
      .reduce((res, [key, value]) => {
        return res.replace(`{${key}}`, `${value}`)
      }, url);
  }
  