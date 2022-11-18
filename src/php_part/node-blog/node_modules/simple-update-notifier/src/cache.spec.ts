import { createConfigDir, getLastUpdate, saveLastUpdate } from 'simple-update-notifier/src/cache';

createConfigDir();

jest.useFakeTimers().setSystemTime(new Date('2022-01-01'));

const fakeTime = new Date('2022-01-01').getTime();

test('can save update then get the update details', () => {
  saveLastUpdate('test');
  expect(getLastUpdate('test')).toBe(fakeTime);
});
