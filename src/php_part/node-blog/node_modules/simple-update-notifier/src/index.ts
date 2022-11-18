import isNpmOrYarn from 'simple-update-notifier/src/isNpmOrYarn';
import hasNewVersion from 'simple-update-notifier/src/hasNewVersion';
import { IUpdate } from 'simple-update-notifier/src/types';
import borderedText from 'simple-update-notifier/src/borderedText';

const simpleUpdateNotifier = async (args: IUpdate) => {
  if (
    !args.alwaysRun &&
    (!process.stdout.isTTY || (isNpmOrYarn && !args.shouldNotifyInNpmScript))
  ) {
    return;
  }

  try {
    const latestVersion = await hasNewVersion(args);
    if (latestVersion) {
      console.log(
        borderedText(`New version of ${args.pkg.name} available!
Current Version: ${args.pkg.version}
Latest Version: ${latestVersion}`)
      );
    }
  } catch {
    // Catch any network errors or cache writing errors so module doesn't cause a crash
  }
};

export default simpleUpdateNotifier;
